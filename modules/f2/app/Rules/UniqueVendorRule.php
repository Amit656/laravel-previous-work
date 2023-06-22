<?php

namespace Modules\Vendor\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Modules\Vendor\App\Models\Vendor;

class UniqueVendorRule implements ValidationRule
{
    private string $threePlId;

    private int $threePlCustomerId;

    private ?string $vendorId;

    /**
     * construct
     *
     * @param  string  $threePlId
     * @param  ?string  $vendorId
     */
    public function __construct(?string $vendorId)
    {
        $this->threePlId = 4;
        $this->threePlCustomerId = 1;
        $this->vendorId = $vendorId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $vendorId = $this->vendorId;
        $existVendor = Vendor::where('name', $value)
            ->where('three_pl_id', $this->threePlId)
            ->where('three_pl_customer_id', $this->threePlCustomerId)
            ->when($vendorId, function ($query) use ($vendorId) {
                return $query->whereNot('id', $vendorId);
            })->count();            
        if ($existVendor) {
            $fail(trans('vendor::messages.validation.vendor_exists', ['attribute' => $attribute]));
        }
    }
}
