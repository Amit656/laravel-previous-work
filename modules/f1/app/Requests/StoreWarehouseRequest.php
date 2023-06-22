<?php

namespace Modules\Warehouse\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Warehouse\App\Rules\UniqueWarehouseRule;

class StoreWarehouseRequest extends FormRequest
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
                'max:255',
                new UniqueWarehouseRule($this->threePlId, $this->warehouse->id ?? null),
            ],
            'latitude' => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude' => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'address' => 'required|string|min:3|max:255',
            'pin_code' => 'required|string|min:3|max:10',
            'city' => 'required|string|min:3|max:255',
            'province' => 'required|string|min:3|max:255',
            'country' => 'required|integer',
            'threshold_settings' => 'required|array|min:1',
            'threshold_settings.three_pl_customers' => 'required|integer',
            'threshold_settings.sku' => 'required|integer',
            'threshold_settings.orders' => 'required|integer',
            'threshold_settings.stores' => 'required|integer',
        ];
    }
}
