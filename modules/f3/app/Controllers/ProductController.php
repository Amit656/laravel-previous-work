<?php

namespace Modules\Product\App\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Product\App\Models\Product;
use Modules\Product\App\Repositories\ProductRepositoryInterface;
use Modules\Product\App\Requests\DeleteProductRequest;
use Modules\Product\App\Requests\ListProductRequest;
use Modules\Product\App\Requests\SearchProductsForVendorRequest;
use Modules\Product\App\Requests\ShowProductRequest;
use Modules\Product\App\Requests\StoreProductRequest;
use Modules\Product\App\Requests\UpdateProductRequest;
use Modules\Product\App\Resources\ProductsForVendorResource;
use Modules\Vendor\App\Models\Vendor;

class ProductController extends Controller
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
        $this->authorizeResource(Product::class, 'product');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function index(ListProductRequest $request): ApiSuccessResponse
    {
        $loggedUser = Auth::user();

        return new ApiSuccessResponse(
            $this->productRepository->getAllProduct($request->all(), $loggedUser),
            ['message' => trans('product::messages.index_success')],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\Product\App\Requests\StoreProductRequest  $request
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function store(StoreProductRequest $request): ApiSuccessResponse
    {
        $loggedUser = Auth::user();
        $this->productRepository->store($request->validated(), $loggedUser);

        return new ApiSuccessResponse(
            [],
            ['message' => trans('product::messages.product_added')],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\Product\App\Requests\ShowProductRequest  $request
     * @param  \Modules\Product\App\Models\Product  $product
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function show(ShowProductRequest $request, Product $product): ApiSuccessResponse
    {
        $product->load(['images', 'vendors']);

        return new ApiSuccessResponse(
            $product,
            ['message' => trans('product::messages.product_show')],
            Response::HTTP_FOUND
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Product\App\Requests\UpdateProductRequest  $request
     * @param  \Modules\Product\App\Models\Product  $product
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function update(UpdateProductRequest $request, Product $product): ApiSuccessResponse
    {
        $loggedUserId = Auth::user()->id ?? 1;

        $this->productRepository->update($product, $loggedUserId, $request->validated());

        return new ApiSuccessResponse(
            [],
            ['message' => trans('product::messages.product_updated')],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Product\App\Requests\DeleteProductRequest  $request
     * @param  \Modules\Product\App\Models\Product  $product
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function destroy(DeleteProductRequest $request, Product $product): ApiSuccessResponse
    {
        $loggedUserId = Auth::user()->id ?? 1;
        $isDeleted = $this->productRepository->delete($product, $loggedUserId);

        $message = trans('product::messages.product_deleted');
        $statusCode = Response::HTTP_OK;
        if ($isDeleted === false) {
            $message = trans('product::validations.something_went_wrong_while_deleting_product');
            $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return new ApiSuccessResponse(
            $isDeleted,
            ['message' => $message],
            $statusCode
        );
    }

    /**
     *  Display a listing of the resource.
     *
     * @param  \Modules\Product\App\Requests\SearchProductsForVendorRequest  $request
     * @param  \Modules\Vendor\App\Models\Vendor  $vendor
     */
    public function searchProductsForVendor(Vendor $vendor, SearchProductsForVendorRequest $request)
    {
        // $this->authorize('searchProductsForVendor', Vendor::class);

        return ProductsForVendorResource::collection(
            $this->productRepository->searchProductsForVendor($vendor, $request->validated())
        );
    }
}
