<?php

namespace Modules\Warehouse\App\Controllers;

use App\Helpers\StUtility;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;
use Illuminate\Support\Facades\Auth;
use Modules\Warehouse\App\Models\Warehouse;
use Modules\Warehouse\App\Repositories\WarehouseRepositoryInterface;
use Modules\Warehouse\App\Requests\CheckWarehouseExistsRequest;
use Modules\Warehouse\App\Requests\ListWarehouseRequest;
use Modules\Warehouse\App\Requests\ShowWarehouseRequest;
use Modules\Warehouse\App\Requests\StoreCustomerWarehousesRequest;
use Modules\Warehouse\App\Requests\StoreWarehouseRequest;
use Modules\Warehouse\App\Requests\UpdateWarehouseRequest;
use StallionExpress\AuthUtility\Enums\UserTypeEnum;
use Symfony\Component\HttpFoundation\Response;

class WarehouseController extends Controller
{
    private WarehouseRepositoryInterface $warehouseRepository;

    public function __construct(WarehouseRepositoryInterface $warehouseRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
        //$this->authorizeResource(Warehouse::class, 'warehouse');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function index(ListWarehouseRequest $request, string $threePlId): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            $this->warehouseRepository->getAllWarehouses($threePlId, $request->all()),
            ['message' => trans('warehouse::messages.index_success')],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function store(string $threePlId, StoreWarehouseRequest $request): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            $this->warehouseRepository->store($threePlId, $request->validated()),
            ['message' => trans('warehouse::messages.warehouse_added')],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\Warehouse\App\Models\Warehouse  $warehouse
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function show(ShowWarehouseRequest $request, string $threePlId, Warehouse $warehouse): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            $this->warehouseRepository->getByParams([
                ['id', $warehouse->id],
                ['three_pl_id', $threePlId],
            ]),
            ['message' => trans('warehouse::messages.warehouse_show')],
            Response::HTTP_FOUND
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Warehouse\App\Requests\UpdateWarehouseRequest  $request
     * @param  \Modules\Warehouse\App\Models\Warehouse  $warehouse
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function update(UpdateWarehouseRequest $request, string $threePlId, Warehouse $warehouse): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            $this->warehouseRepository->update($warehouse, $threePlId, $request->validated()),
            ['message' => trans('warehouse::messages.warehouse_updated')],
            Response::HTTP_OK
        );
    }

    public function get3plWarehouses(string $threePlId): ApiSuccessResponse
    {
        $threePlId = (Auth::check()) ? \AuthUtility::getThreePlIdFor3PlAndStaff(Auth::user()) : $threePlId;

        return new ApiSuccessResponse(
            $this->warehouseRepository->warehouses($threePlId),
            ['message' => trans('warehouse::messages.warehouse_show')],
            Response::HTTP_OK
        );
    }

    public function getWarehouses(int $threeCustomer = null): ApiSuccessResponse
    {
        $id = Auth::user()->id;
        $userType = Auth::user()->user_type->value;
        $warehouse = [];
        // if logged in user is 3pl or 3pl staff user can pass 3pl customer id to get warehouses of specific 3pl customer
        if ($threeCustomer && in_array($userType, [(UserTypeEnum::THREE_PL)->value, (UserTypeEnum::THREE_PL_STAFF)->value])) {
            $warehouse = $this->warehouseRepository->threePlCustomerWarehouses($threeCustomer);
        } elseif (in_array($userType, [(UserTypeEnum::THREE_PL)->value, (UserTypeEnum::THREE_PL_STAFF)->value])) {
            // if logged in 3pl then return its all warehouse
            $warehouse = $this->warehouseRepository->warehouses($id);
        } else {
            // if logged in user is 3pl customer or 3pl customer staff then return its all warehouse
            $warehouse = $this->warehouseRepository->threePlCustomerWarehouses($id);
        }

        return new ApiSuccessResponse(
            $warehouse,
            ['message' => trans('warehouse::messages.warehouse_show')],
            Response::HTTP_OK
        );
    }

    /**
     * Attach three customer warehouses
     *
     * @param  int  $userId
     * @return ApiSuccessResponse
     */
    public function attachCustomerWarehouses(StoreCustomerWarehousesRequest $request, $threeCustomerId): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            $this->warehouseRepository->attachCustomerWarehouses($request->validated(), $threeCustomerId),
            ['message' => trans('warehouse::messages.warehouse_show')],
            Response::HTTP_OK
        );
    }

    /**
     * Check the specified resource.
     *
     * @param  \Modules\Warehouse\App\Requests\CheckWarehouseExistsRequest  $request
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function checkWarehouseExists(CheckWarehouseExistsRequest $request): ApiSuccessResponse
    {
        $warehouseExists = $this->warehouseRepository->warehouseExists($request->validated());

        $message = trans('warehouse::messages.warehouse_exists');
        $statusCode = Response::HTTP_FOUND;
        if ($warehouseExists === false) {
            $message = trans('warehouse::messages.warehouse_invalid');
            $statusCode = Response::HTTP_NOT_FOUND;
        }

        return new ApiSuccessResponse(
            $warehouseExists,
            ['message' => $message],
            $statusCode
        );
    }
}
