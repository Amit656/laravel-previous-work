<?php

namespace Modules\Product\App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsForVendorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'hash' => $this->hash,
            'name' => $this->name,
            'sku' => $this->sku,
        ];
    }
}
