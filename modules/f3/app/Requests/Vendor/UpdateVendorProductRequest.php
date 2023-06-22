<?php

namespace Modules\Product\App\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVendorProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'price' => ['nullable', 'numeric', 'between:0,99999999.99'],
            'manufacturer_sku' => ['nullable', 'string'],
        ];
    }
}
