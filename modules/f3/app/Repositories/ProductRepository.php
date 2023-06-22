<?php

namespace Modules\Product\App\Repositories;

use App\Helpers\StUtility;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Product\App\Models\Product;
use Modules\Vendor\App\Models\Vendor;
use StallionExpress\AuthUtility\Enums\UserTypeEnum;
use StallionExpress\AuthUtility\Models\User;
use StallionExpress\AuthUtility\Trait\STEncodeDecodeTrait;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    use STEncodeDecodeTrait;

    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    /**
     * List Product
     *
     * @param  array  $request
     * @return \Illuminate\Pagination\Paginator
     */
    public function getAllProduct($request, User $user): \Illuminate\Pagination\AbstractPaginator
    {
        $threePlCustomerId = $request['three_pl_customer_id'] ?? null;
        $search = $request['search'] ?? '';
        $status = $request['status'] ?? '';
        $recordPerPage = $request['per_page'] ?? 10;

        return $this->getSimplePaginated()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($searchQuery) use ($search) {
                    $searchQuery->where('name', 'like', '%'.$search.'%');
                    $searchQuery->orWhere('sku', 'like', '%'.$search.'%');
                });
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', '=', $status);
            })
            ->when(in_array($user->user_type->value,
                [UserTypeEnum::THREE_PL_CUSTOMER->value, UserTypeEnum::THREE_PL_CUSTOMER_STAFF->value]),
                function ($query) use ($user) {
                    $query->where('three_pl_customer_id', \AuthUtility::getCustomerIdFor3PlCustomerAndStaff($user));
                })
            ->when(in_array($user->user_type->value,
                [UserTypeEnum::THREE_PL->value, UserTypeEnum::THREE_PL_STAFF->value]),
                function ($query) use ($user, $threePlCustomerId) {
                    $query->when($threePlCustomerId, function ($wQuery) use ($threePlCustomerId) {
                        $wQuery->where('three_pl_customer_id', $threePlCustomerId);
                    });

                    $query->whereIn('warehouse_id', \AuthUtility::getLoggedUserAssociatedWarehousesIds($user));
                })
            ->orderBy('id', 'DESC')
            ->paginate($recordPerPage);
    }

    /**
     * Store a newly created resource in storage.
     *
     *  @param  array  $input
     *  @param  int  $loggedUserId
     *  @return \Modules\Product\App\Models\Product
     */
    public function store(array $input, User $user): Product|bool
    {
        try {
            // begin transaction
            DB::beginTransaction();
            $product = $this->create([
                'name' => $input['name'],
                'three_pl_customer_id' => \AuthUtility::getCustomerIdFor3PlCustomerAndStaff(Auth::user(), $input['three_pl_customer_id'] ?? null),
                'warehouse_id' => $input['warehouse_id'],
                'is_kit' => $input['is_kit'],
                'value' => $input['value'],
                'weight' => $input['weight'],
                'sku' => $input['sku'],
                'barcode' => $input['barcode'],
                'status' => true,
                'last_updated_by' => $user->id,
            ]);

            $product = Product::find($product->id);  /** @phpstan-ignore-line */
            if ($product) {
                if (isset($input['vendors']) && count($input['vendors'])) {
                    $vendors = app(ProductVendorInterface::class)->store($input['vendors'], $product);

                    if ($vendors === false) {
                        return false;
                    }
                }
                if (isset($input['images']) && count($input['images'])) {
                    $images = app(ProductImageInterface::class)->store($input['images'], $product);

                    if ($images === false) {
                        return false;
                    }
                }

                DB::commit();
            }

            return $product;
        } catch (Exception $e) {
            // May day,  rollback!!! rollback!!!
            DB::rollback();
            Log::error(json_encode($e));

            return false;
        }
    }

    /**
     * Update the specified resource in storage.

     *
     *  @param  \Modules\Product\App\Models\Product  $product
     *  @param  int  $loggedUserId
     *  @param  array  $input
     *  @return \Modules\Product\App\Models\Product
     */
    public function update(Product $product, int $loggedUserId, array $input): Product|bool
    {
        $serialNumber = $product->serial_number;
        $barcode = $product->barcode;

        if (isset($input['need_serial_number']) && ! empty($input['need_serial_number']) && empty($product->serial_number)) {
            $serialNumber = Product::generateUniqueSerialNumber();
        }

        if (empty($barcode)) {
            $barcode = Product::generateBarcodeCode();
        }

        unset($input['images'], $input['vendors'], $input['three_pl_customer_id']);

        $this->updateBy('id', $product->id, array_merge($input, [
            'serial_number' => $serialNumber,
            'barcode' => $barcode,
            'last_updated_by' => $loggedUserId,
        ]));

        $product->refresh();

        return $product;
    }

    /**
     * Delete the specified resource.
     *
     *  @param  \Modules\Product\App\Models\Product  $product
     *  @param  int  $loggedUserId
     */
    public function delete(Product $product, int $loggedUserId): bool
    {
        try {
            // begin transaction
            DB::beginTransaction();
            app(ProductVendorInterface::class)->delete($product);

            app(ProductImageInterface::class)->delete($product);

            $product->update(['last_updated_by' => $loggedUserId]);
            $isDeleted = $product->delete();
            DB::commit();

            return $isDeleted;
        } catch (\Exception $e) {
            // May day,  rollback!!! rollback!!!
            DB::rollback();
            Log::error(json_encode($e));

            return false;
        }
    }

    /**
     * List Products for vendor
     *
     * @param  \Modules\Vendor\App\Models\Vendor  $vendor
     * @param  array  $request
     * @return Collection
     */
    public function searchProductsForVendor(Vendor $vendor, array $request): Collection
    {
        $sortByKey = $request['sort_by'] ?? 'created_at';
        $sortByValue = $request['sort_by_value'] ?? 'DESC';
        $search = $request['search'] ?? '';

        $productId = app(ProductVendorInterface::class)->getVendorProductId($vendor->id);

        $threePlCustomerId = Product::select('three_pl_customer_id')->findOrFail($productId);

        $vendorThreePlCustomerId = $this->decodeHashValue($threePlCustomerId->three_pl_customer_id);

        return $this->newQuery()
            ->select('id', 'name', 'sku')
            ->where('three_pl_customer_id', $vendorThreePlCustomerId)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($searchQuery) use ($search) {
                    $searchQuery->where('name', 'like', '%'.$search.'%');
                    $searchQuery->orWhere('sku', 'like', '%'.$search.'%');
                });
            })
            ->orderBy($sortByKey, $sortByValue)
            ->get();
    }
}
