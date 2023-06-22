<?php

namespace Modules\Warehouse\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckWarehouseExistsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'warehouses' => 'required|array',
            'three_pl_customer_id' => 'nullable|integer',
        ];
    }
}
