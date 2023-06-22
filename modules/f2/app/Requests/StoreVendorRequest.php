<?php

namespace Modules\Vendor\App\Requests;

use App\Helpers\StUtility;
use Illuminate\Support\Facades\Auth;
use App\Rules\ThreePlCustomerExistsRule;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Vendor\App\Rules\CurrencyCheckRule;
use StallionExpress\AuthUtility\Enums\UserTypeEnum;

class StoreVendorRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:50',
                //new UniqueVendorRule($this->vendor->ulid ?? null),
            ],
            'email' => 'required|string|max:255',
            'account_number' => 'nullable|alpha_num|max:20',
            'internal_note' => 'nullable|string|max:255',
            'po_note' => 'nullable|string|max:255',
            'address_one' => 'nullable|string|max:255',
            'address_two' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:50',
            'zip_code' => 'nullable|string|max:6',
            'country' => 'nullable|integer',
            'state' => 'nullable|string',
            'currency' => [
                'nullable',
                'integer',
                new CurrencyCheckRule(),

            ],
        ];

        if(\AuthUtility::isUser3plOr3plStaff(Auth::user())){
            $rules['customer_id'] = ['required', 'array', new ThreePlCustomerExistsRule($this->bearerToken())];
        }

        return $rules;
    }
}
