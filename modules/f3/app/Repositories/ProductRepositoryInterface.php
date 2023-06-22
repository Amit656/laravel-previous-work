<?php

namespace Modules\Product\App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Product\App\Models\Product;
use Modules\Vendor\App\Models\Vendor;
use StallionExpress\AuthUtility\Models\User;

interface ProductRepositoryInterface
{
    public function store(array $request, User $user): Product|bool;

    public function getAllProduct(array $request, User $user): \Illuminate\Pagination\AbstractPaginator;

    public function update(Product $product, int $loggedUserId, array $request): Product|bool;

    public function delete(Product $product, int $loggedUserId): bool;

    public function searchProductsForVendor(Vendor $vendor, array $request): Collection;
}
