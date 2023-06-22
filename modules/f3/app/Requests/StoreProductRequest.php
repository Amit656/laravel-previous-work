<?php

namespace Modules\Product\App\Requests;

use App\Helpers\StUtility;
use App\Rules\ThreePlCustomerExistsRule;
use App\Rules\VendorExistsRule;
use App\Rules\WarehouseExistsRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use StallionExpress\AuthUtility\Enums\UserTypeEnum;

class StoreProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'warehouse_id' => ['required', 'string', new WarehouseExistsRule($this->bearerToken())],
            'name' => 'required|string|max:50|unique:products,name,NULL,id,warehouse_id,'.$this->warehouse_id,
            'is_kit' => 'required|boolean',
            'value' => 'numeric|nullable|numeric|between:0,99999999.99',
            'weight' => 'numeric|nullable|numeric|between:0,99999999.99',
            'sku' => 'required|string|max:255|unique:products,sku,NULL,id,three_pl_customer_id,'.$this->three_pl_customer_id,
            'barcode' => 'nullable|integer',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'vendors' => ['nullable', 'array', new VendorExistsRule($this->bearerToken())],
        ];

        if (\AuthUtility::isUser3plOr3plStaff(Auth::user())) {
            $rules['three_pl_customer_id'] = ['required', new ThreePlCustomerExistsRule($this->bearerToken())];
            $rules['warehouse_id'] = ['required', 'string', new WarehouseExistsRule($this->bearerToken(), $this->three_pl_customer_id)];
            $rules['vendors'] = ['nullable', 'array', new VendorExistsRule($this->bearerToken(), $this->three_pl_customer_id)];
        }

        return $rules;
    }

    protected function prepareForValidation(): void
    {
        if (\AuthUtility::isUserCustomerOrCustomerStaff(Auth::user())) {
            $this->merge([
                'three_pl_customer_id' => \AuthUtility::getCustomerIdFor3PlCustomerAndStaff(Auth::user()),
            ]);
        }
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'three_pl_customer_id.required_if' => trans('product::validations.required_for_three_pl_user_type'),
        ];
    }
}
