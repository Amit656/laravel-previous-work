<?php

namespace Modules\Product\App\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Modules\Product\App\Models\Product;
use Modules\Product\App\Repositories\ProductVendorInterface;
use Modules\Product\App\Requests\DeleteVendorProductRequest;
use Modules\Product\App\Requests\Vendor\AssignProductToVendorRequest;
use Modules\Product\App\Requests\Vendor\ProductVendorsRequest;
use Modules\Product\App\Requests\Vendor\UpdateVendorProductRequest;
use Modules\Product\App\Requests\Vendor\VendorProductsGetRequest;
use Modules\Product\App\Resources\ProductVendorsResource;
use Modules\Product\App\Resources\VendorProductResource;
use Modules\Vendor\App\Models\Vendor;
use StallionExpress\AuthUtility\Trait\STEncodeDecodeTrait;

class VendorProductController extends Controller
{
    use STEncodeDecodeTrait;

    private ProductVendorInterface $vendorProductRepository;

    public function __construct(ProductVendorInterface $productRepository)
    {
        $this->vendorProductRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     *@param  \Modules\Vendor\App\Models\Vendor  $vendor
     * @param  \Modules\Product\App\Requests\Vendor\VendorProductsGetRequest  $request
     *
     */
    public function getVendorProduct(Vendor $vendor, VendorProductsGetRequest $request)
    {
        // $this->authorize('productsByVendor', Vendor::class);

        return VendorProductResource::collection(
            $this->vendorProductRepository->getVendorProduct($vendor, $request->validated())
        );
    }

    /**
     * Display a listing of the resource.
     *
     *
     */
    public function getProductVendors(Product $product, ProductVendorsRequest $request)
    {
        return ProductVendorsResource::collection(
            $this->vendorProductRepository->getProductVendors($product, $request->validated())
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Product\App\Requests\DeleteVendorProductRequest  $request
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function deleteVendorProduct(DeleteVendorProductRequest $request): ApiSuccessResponse
    {
        $this->vendorProductRepository->deleteVendorProduct($request->validated());

        return new ApiSuccessResponse(
            [],
            ['message' => trans('product::messages.product_deleted')],
            Response::HTTP_OK
        );
    }

    /* Update the specified resource in storage.
     *
     * @param  \Modules\Product\App\Requests\Vendor\UpdateVendorProductRequest  $request
     * @param  string  $productVendorId
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function updateVendorProduct(UpdateVendorProductRequest $request, string $productVendorId): ApiSuccessResponse
    {
        $this->vendorProductRepository->updateVendorProduct($productVendorId, $request->validated());

        return new ApiSuccessResponse(
            [],
            ['message' => trans('product::messages.vendor_product_updated')],
            Response::HTTP_OK
        );
    }

    /**
     * * Store a newly created resource in storage.
     *
     * @param  \Modules\Product\App\Requests\Vendor\AssignProductToVendorRequest  $request
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function assignProductToVendor(AssignProductToVendorRequest $request): ApiSuccessResponse
    {
        // $this->authorize('assignProductToVendor', Vendor::class);

        $this->vendorProductRepository->setProductToVendor($request->all());

        return new ApiSuccessResponse(
            [],
            ['message' => trans('product::messages.product_assign_to_vendor')],
            Response::HTTP_CREATED
        );
    }
}
