<?php

namespace Modules\Warehouse\App\Requests;

class UpdateWarehouseRequest extends StoreWarehouseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return parent::rules();
    }
}
