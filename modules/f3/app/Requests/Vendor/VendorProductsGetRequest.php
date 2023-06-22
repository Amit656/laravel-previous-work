<?php

namespace Modules\Product\App\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class VendorProductsGetRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'page' => 'required|integer',
            'per_page' => 'required|integer',
        ];
    }
}
