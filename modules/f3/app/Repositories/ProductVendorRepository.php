<?php

namespace Modules\Product\App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Modules\Product\App\Models\Product;
use Modules\Product\App\Models\ProductVendor;
use Modules\Vendor\App\Models\Vendor;
use StallionExpress\AuthUtility\Trait\STEncodeDecodeTrait;

class ProductVendorRepository extends BaseRepository implements ProductVendorInterface
{
    use STEncodeDecodeTrait;

    public function __construct(ProductVendor $productVendor)
    {
        parent::__construct($productVendor);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(array $vendors, Product $product): bool
    {
        $vendorsToSaved = [];
        foreach ($vendors as $vendor) {
            $vendorsToSaved[] = [
                'vendor_id' => $vendor,
                'product_id' => $product->id,
            ];
        }

        return ProductVendor::insert($vendorsToSaved);
    }

    public function delete(Product $product): bool
    {
        return ProductVendor::where('product_id', $product->id)->delete();
    }

    public function deleteByIds(Product $product, array $vendors): bool
    {
        return ProductVendor::where('product_id', $product->id)
            ->whereIn('vendor_id', $vendors)->delete();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(array $vendors, Product $product): bool
    {
        //Getting all existing vendors
        $existingVendors = $this->getAllByParams([['product_id', $product->id]])->pluck('vendor_id')->toArray();

        //Getting vendors to delete
        $vendorsToDelete = array_diff($existingVendors, $vendors);

        //Getting vendors to save
        $vendorsToSave = array_diff($vendors, $existingVendors);

        //saving new added vendors
        if (count($vendorsToSave)) {
            $this->store($vendorsToSave, $product);
        }

        //Deleting vendors
        if (count($vendorsToDelete)) {
            $this->deleteByIds($product, $vendorsToDelete);
        }

        return true;
    }

    /**
     * @return \Illuminate\Pagination\Paginator
     */
    public function getVendorProduct(Vendor $vendor, array $request): \Illuminate\Pagination\AbstractPaginator
    {
        $recordPerPage = $request['per_page'] ?? 10;
        $sortByKey = $request['sort_by'] ?? 'created_at';
        $sortByValue = $request['sort_by_value'] ?? 'DESC';
        $search = $request['search'] ?? '';

        return $this->newQuery()
            ->with('product:id,name,sku')
            ->where('vendor_id', $vendor->id)
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%');
                $query->orWhere('sku', 'like', '%'.$search.'%');
            })
            ->orderBy($sortByKey, $sortByValue)
            ->paginate($recordPerPage);
    }

    /**
     * @param  array  $request
     * @return  bool
     */
    public function setProductToVendor(array $request): ProductVendor
    {
        return ProductVendor::create($request);
    }

    /**
     * @return \Illuminate\Pagination\Paginator
     */
    public function getProductVendors(Product $product, array $request): Paginator
    {
        $recordPerPage = $request['per_page'] ?? 10;
        $sortByKey = $request['sort_by'] ?? 'created_at';
        $sortByValue = $request['sort_by_value'] ?? 'DESC';

        return $this->newQuery()
            ->with('vendor')
            ->where('product_id', $product->id)
            ->orderBy($sortByKey, $sortByValue)
            ->paginate($recordPerPage);
    }

    /**
     * Delete the specified resource.
     *
     * @param  array  $request
     * @return  bool
     */
    public function deleteVendorProduct(array $request): bool
    {
        return ProductVendor::where('product_id', $request['product_id'])
            ->where('vendor_id', $request['vendor_id'])
            ->delete();
    }

    /* Update the specified resource in storage.
     *
     *  @param  string  $productVendorId
     *  @param  array  $input
     *  @return int
     */
    public function updateVendorProduct(string $productVendorId, array $input): int
    {
        return $this->updateBy('id', $productVendorId, [
            'price' => $input['price'],
            'manufacturer_sku' => $input['manufacturer_sku'],
        ]);
    }

    /**
     * Get vendor Product_id
     *
     * @param  int  $vendorId
     * @return int|null
     */
    public function getVendorProductId($vendorId): int|null
    {
        $productId = ProductVendor::select(['product_id'])->where('vendor_id', $vendorId)->first();

        return ($productId) ? $productId->product_id : null;
    }
}
