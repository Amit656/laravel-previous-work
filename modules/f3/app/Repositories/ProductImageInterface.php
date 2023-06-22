<?php

namespace Modules\Product\App\Repositories;

use Modules\Product\App\Models\Product;

interface ProductImageInterface
{
    public function store(array $images, Product $product): bool;

    public function delete(Product $product): bool;
}
