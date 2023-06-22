<?php

namespace Modules\Vendor\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Vendor\App\Rules\CurrencyCheckRule;

class UpdateVendorRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
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
            'customer_id' => 'nullable|required_if:login_type,three_pl|array',
        ];
    }
}
