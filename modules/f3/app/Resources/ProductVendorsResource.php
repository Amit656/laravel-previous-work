<?php

namespace Modules\Product\App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVendorsResource extends JsonResource
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
            'details' => [
                'name' => $this->vendor->name,
                'email' => $this->vendor->email,
                'account_number' => $this->vendor->account_number,
                'hash' => $this->vendor->hash,
            ],
        ];
    }
}
