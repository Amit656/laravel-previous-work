<?php

namespace Modules\Product\App\Requests\Vendor;

use App\Rules\VendorExistsRule;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Product\App\Rules\VendorProductRelationRule;

class AssignProductToVendorRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_id' => ['required', 'string', new VendorProductRelationRule($this->vendor_id)],
            'vendor_id' => ['required', 'string', new VendorExistsRule($this->bearerToken())],
        ];
    }
}
