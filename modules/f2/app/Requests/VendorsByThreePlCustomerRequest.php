<?php

namespace Modules\Vendor\App\Requests;

use Illuminate\Support\Facades\Auth;
use App\Rules\ThreePlCustomerExistsRule;
use Illuminate\Foundation\Http\FormRequest;
use StallionExpress\AuthUtility\Enums\UserTypeEnum;

class VendorsByThreePlCustomerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'three_pl_customer' => ['nullable','string', new ThreePlCustomerExistsRule($this->bearerToken())],
            'search' => 'string',
        ];
    }
}
