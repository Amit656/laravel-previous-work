<?php

namespace Modules\Warehouse\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Modules\Warehouse\App\Models\Warehouse;

class UniqueWarehouseRule implements ValidationRule
{
    private string $threePlId;

    private ?string $warehouseId;

    /**
     * construct
     *
     * @param  string  $threePlId
     * @param  ?string  $warehouseId
     */
    public function __construct(string $threePlId, ?string $warehouseId)
    {
        $this->threePlId = $threePlId;
        $this->warehouseId = $warehouseId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $warehouseId = $this->warehouseId;
        $existWarehouse = Warehouse::where('name', $value)
            ->where('three_pl_id', $this->threePlId)
            ->when($warehouseId, function ($query) use ($warehouseId) {
                return $query->whereNot('id', $warehouseId);
            })->count();

        if ($existWarehouse) {
            $fail(trans('warehouse::messages.validation.warehouse_exists', ['attribute' => $attribute]));
        }
    }
}
