<?php

namespace Modules\Product\App\Repositories;

use App\Helpers\Helper;
use App\Repositories\BaseRepository;
use Modules\Product\App\Models\Product;
use Modules\Product\App\Models\ProductImage;

class ProductImageRepository extends BaseRepository implements ProductImageInterface
{
    public function __construct(ProductImage $productImage)
    {
        parent::__construct($productImage);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(array $images, Product $product): bool
    {
        $imagesToSaved = [];
        foreach ($images as $image) {
            if (is_null($image)) {
                continue;
            }

            $imageName = Helper::saveImage($image, ProductImage::IMAGE_PATH.'/'.$product->id);
            $imagesToSaved[] = [
                'image' => $imageName,
                'product_id' => $product->id,
            ];
        }

        ProductImage::insert($imagesToSaved);

        return true;
    }

    public function delete(Product $product): bool
    {
        Helper::deleteDirectory(ProductImage::IMAGE_PATH.'/'.$product->id);

        return ProductImage::where('product_id', $product->id)->delete();
    }
}
