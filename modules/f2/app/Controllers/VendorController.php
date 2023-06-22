<?php

namespace Modules\Vendor\App\Controllers;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Vendor\App\Models\Vendor;
use App\Http\Responses\ApiSuccessResponse;
use Modules\Vendor\App\Requests\ListVendorRequest;
use Modules\Vendor\App\Requests\ShowVendorRequest;
use Modules\Vendor\App\Requests\StoreVendorRequest;
use StallionExpress\AuthUtility\Enums\UserTypeEnum;
use Modules\Vendor\App\Requests\DeleteVendorRequest;
use Modules\Vendor\App\Requests\UpdateVendorRequest;
use Modules\Vendor\App\Requests\CheckVendorExistsRequest;
use Modules\Vendor\App\Repositories\VendorRepositoryInterface;
use Modules\Vendor\App\Requests\VendorsByThreePlCustomerRequest;
use Modules\Vendor\App\Requests\ProductsByVendorsRequest;

class VendorController extends Controller
{
    private VendorRepositoryInterface $vendorRepository;

    public function __construct(VendorRepositoryInterface $vendorRepository)
    {
        $this->vendorRepository = $vendorRepository;
        $this->authorizeResource(Vendor::class, ['vendor']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListVendorRequest $request): ApiSuccessResponse
    {
        $vendor = $this->vendorRepository->getAllVendors($request->all(), Auth::user());

        return new ApiSuccessResponse(
            $vendor,
            ['message' => trans('vendor::messages.index_success')],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Modules\Vendor\App\Requests\StoreVendorRequest $request
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function store(StoreVendorRequest $request): ApiSuccessResponse
    {
        $this->vendorRepository->store(Auth::user(), $request->validated());

        return new ApiSuccessResponse(
            [],
            ['message' => trans('vendor::messages.vendor_added')],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     * @param  string  $id
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function show(ShowVendorRequest $request, Vendor $vendor): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            $vendor,
            ['message' => trans('vendor::messages.vendor_show')],
            Response::HTTP_FOUND
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\vendor\App\Requests\UpdateVendorRequest  $request
     * @param  \Modules\vendor\App\Models\Vendor  $vendor
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function update(UpdateVendorRequest $request, Vendor $vendor): ApiSuccessResponse
    {
        $userId = Auth::user()->id;

        return new ApiSuccessResponse(
            $this->vendorRepository->update($vendor, Auth::user()->id, $request->validated()),
            ['message' => trans('vendor::messages.vendor_updated')],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteVendorRequest $request, Vendor $vendor): ApiSuccessResponse
    {
        $isDeleted = $vendor->delete();

        return new ApiSuccessResponse(
            null,
            ['message' => $isDeleted ? trans('vendor::messages.vendor_deleted') : 'Error in deleting vendor'],
            Response::HTTP_OK
        );
    }

    /**
     * Get vendors by 3pl customer
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function getVendorsBy3plCustomers(VendorsByThreePlCustomerRequest $request): ApiSuccessResponse
    {
        // $this->authorize('vendorsBy3plCustomer', Vendor::class);
        $id = Auth::user()->id;
        $userType = Auth::user()->user_type->value;
        $customerID = $request->all()['three_pl_customer'] ?? null;
        $search = $request->all()['search'] ?? '';
        $vendors = [];

        // if logged in user is 3pl or 3pl staff user can pass 3pl customer id to get warehouses of specific 3pl customer
        if($customerID && in_array($userType, [(UserTypeEnum::THREE_PL)->value, (UserTypeEnum::THREE_PL_STAFF)->value])){
            $vendors = $this->vendorRepository->getVendorsBy3plCustomer($customerID,$search);
        }else if (in_array($userType, [(UserTypeEnum::THREE_PL)->value, (UserTypeEnum::THREE_PL_STAFF)->value])){
            // if logged in 3pl then return its all warehouse            
            $vendors = $this->vendorRepository->getVendorsBy3plCustomer($id, $search);
        }

        return new ApiSuccessResponse(
            $vendors,
            ['message' => trans('vendor::messages.index_success')],
            Response::HTTP_OK
        );
    }

    /**
     * Check the specified resource.
     * @param  \Modules\Vendor\App\Requests\CheckVendorExistsRequest $request
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function checkVendorExists(CheckVendorExistsRequest $request): ApiSuccessResponse
    {
        $vendorExists = $this->vendorRepository->vendorExists($request->validated());

        $message = trans('vendor::validations.vendor_valid');
        $statusCode = Response::HTTP_FOUND;
        if($vendorExists === false){
            $message = trans('vendor::validations.vendor_invalid');
            $statusCode = Response::HTTP_NOT_FOUND;
        }
        return new ApiSuccessResponse(
            $vendorExists,
            ['message' => $message],
            $statusCode
        );
    }

}
