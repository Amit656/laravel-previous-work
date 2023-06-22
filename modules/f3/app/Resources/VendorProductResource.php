<?php

namespace Modules\Product\App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'price' => $this->price,
            'manufacturer_sku' => $this->manufacturer_sku,
            'hash' => $this->hash,
            'product' => [
                'name' => $this->product->name,
                'sku' => $this->product->sku,
                'hash' => $this->product->hash,
            ],
        ];
    }
}
