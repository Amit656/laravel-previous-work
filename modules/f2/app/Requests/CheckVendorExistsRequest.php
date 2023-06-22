<?php
namespace Modules\Vendor\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckVendorExistsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [            
            'vendors' => 'required|array',
            'three_pl_customer_id' => 'nullable|integer',
        ];
    }

}