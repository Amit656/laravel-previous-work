<?php

namespace Modules\Warehouse\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Warehouse\App\Rules\ValidateWarehousesRule;

class StoreCustomerWarehousesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'warehouses' => ['required', 'array'],
            'warehouses.*' => ['exists:warehouses,id', new ValidateWarehousesRule($this->threeCustomerId)],
        ];
    }

    public function messages()
    {
        foreach ($this->get('warehouses') as $key => $val) {
            $messages["warehouses.{$key}"] = trans('warehouse::messages.validation.warehouse_exists_for_customer', ['row' => $key]);
        }

        return $messages;
    }
}
