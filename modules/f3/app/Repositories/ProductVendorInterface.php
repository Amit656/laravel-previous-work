<?php

namespace Modules\Product\App\Repositories;

use Illuminate\Contracts\Pagination\Paginator;
use Modules\Product\App\Models\Product;
use Modules\Product\App\Models\ProductVendor;
use Modules\Vendor\App\Models\Vendor;

interface ProductVendorInterface
{
    public function store(array $vendors, Product $product): bool;

    public function update(array $vendors, Product $product): bool;

    public function delete(Product $product): bool;

    public function setProductToVendor(array $request): ProductVendor;

    public function getVendorProduct(Vendor $vendor, array $request): \Illuminate\Pagination\AbstractPaginator;

    public function getProductVendors(Product $product, array $request): Paginator;

    public function deleteVendorProduct(array $request): bool;

    public function updateVendorProduct(string $productVendorId, array $request): int;

    public function getVendorProductId($vendorId): int|null;
}
