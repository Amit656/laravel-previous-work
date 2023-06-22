<?php

namespace Modules\Warehouse\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Modules\Warehouse\App\Models\ThreePlCustomerWarehouse;

class ValidateWarehousesRule implements ValidationRule
{
    private $threePlCustomerId;

    public function __construct(int $threePlCustomerId)
    {
        $this->threePlCustomerId = $threePlCustomerId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (ThreePlCustomerWarehouse::where('customer_id', $this->threePlCustomerId)
            ->where('warehouse_id', $value)
            ->exists()) {
            $fail(trans('warehouse::messages.warehouse_exists_for_customer'));
        }
    }
}
