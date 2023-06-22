<?php

namespace Modules\Warehouse\App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Warehouse\App\Events\WarehouseCreatedEvent;
use Modules\Warehouse\App\Models\ThreePlCustomerWarehouse;
use Modules\Warehouse\App\Models\Warehouse;

class WarehouseRepository extends BaseRepository implements WarehouseRepositoryInterface
{
    /**
     * @param  Warehouse  $warehouse
     */
    public function __construct(Warehouse $warehouse)
    {
        parent::__construct($warehouse);
    }

    /**
     * Return all Warehouses from the index page
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function getAllWarehouses(string $threePlId, array $request): Paginator
    {
        $search = $request['search'] ?? '';
        $country = $request['country'] ?? '';
        $recordPerPage = $request['limit'] ?? 10;
        $sortByKey = $request['sort_by'] ?? 'created_at';
        $sortByValue = $request['sort_by_value'] ?? 'DESC';

        return $this->getSimplePaginated()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%');
                $query->orWhere('city', 'like', '%'.$search.'%');
                $query->orWhere('province', 'like', '%'.$search.'%');
            })
            ->when($country, function ($query) use ($country) {
                $query->where('country', '=', $country);
            })
            ->where('three_pl_id', $threePlId)
            ->orderBy($sortByKey, $sortByValue)
            ->paginate($recordPerPage);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  string  $threePlId
     * @param  array  $request
     * @return  Warehouse
     */
    public function store(string $threePlId, array $request): Warehouse|null
    {
        $warehouse = null;

        try {
            DB::transaction(function () use ($threePlId, $request, $warehouse) {
                $warehouse = $this->create(array_merge($request, ['three_pl_id' => $threePlId]));

                WarehouseCreatedEvent::dispatch($warehouse);
            });
        } catch (\Exception $e) {
            Log::error($e);
            throw new \Exception($e);
        }

        return $warehouse;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Warehouse\App\Models\Warehouse  $warehouse
     * @param  string  $threePlId
     * @param  array  $request
     * @param  \Modules\Warehouse\App\Models\Warehouse  $warehouse
     */
    public function update(Warehouse $warehouse, string $threePlId, array $request): array
    {
        $this->updateBy('id', $warehouse->id, array_merge($request));

        return [];
    }

    /**
     * Returns all warehouse name
     */
    public function warehouses(int $id)
    {
        // return all warehouses on 3pl customer id
        return $this->newQuery(['id', 'name'])->where('three_pl_id', $id)->get();
    }

    public function threePlCustomerWarehouses(int $threePlCustomer)
    {
        return Warehouse::whereIn('id',
            ThreePlCustomerWarehouse::where('customer_id', $threePlCustomer)->pluck('warehouse_id')->toArray())
            ->get(['name', 'id']);
    }

    /**
     * Attach warehouses to customer
     */
    public function attachCustomerWarehouses(array $request, int $threeCustomerId)
    {
        $warehousesToBeAttached = [];
        foreach ($request['warehouses'] as $warehouse) {
            $warehousesToBeAttached[] = [
                'warehouse_id' => $warehouse,
                'customer_id' => $threeCustomerId,
            ];
        }

        ThreePlCustomerWarehouse::insert($warehousesToBeAttached);

        return ThreePlCustomerWarehouse::where('customer_id', $threeCustomerId)->get();
    }

    /**
     * Check the specified resource.
     *
     * @param  \Modules\Warehouse\App\Requests\CheckWarehouseExistsRequest  $request
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function warehouseExists(array $request): bool
    {
        $warehouseExist = false;
        //check warehouse exist in the system
        $warehouseCount = Warehouse::whereIn('id', $request['warehouses'])->count();

        if ($warehouseCount == count($request['warehouses'])) {
            $warehouseExist = true;
            // check warehouse exist for the 3pl customer
            if (isset($request['three_pl_customer_id']) && ! empty($request['three_pl_customer_id'])) {
                if (ThreePlCustomerWarehouse::where('customer_id', $request['three_pl_customer_id'])
                    ->whereIn('warehouse_id', $request['warehouses'])->count() < 1) {
                    $warehouseExist = false;
                }
            }
        }

        return $warehouseExist;
    }
}
