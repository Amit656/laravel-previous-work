<?php

namespace Modules\Location\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Location\App\Rules\UniqueLocationRule;

class StoreLocationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'location_type_id' => ['required', 'integer', 'exists:location_types,id'],
            'warehouse_id' => 'required|integer|exists:warehouses,id',
            'name' => [
                'required',
                'string',
                'max:50',
                new UniqueLocationRule($this->location->id ?? null),
            ],
            'is_pickable' => 'required|boolean',
            'is_sellable' => 'required|boolean',
        ];
    }
}
