<?php

namespace Modules\Product\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Modules\Product\App\Models\Product;
use Modules\Vendor\App\Models\Vendor;
use StallionExpress\AuthUtility\Trait\STEncodeDecodeTrait;

class VendorProductRelationRule implements ValidationRule
{
    use STEncodeDecodeTrait;

    private string $vendorId;

    /**
     * construct
     *
     * @param  string  $vendorId
     */
    public function __construct(string $vendorId)
    {
        $this->vendorId = $vendorId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $threePlCustomerId = Product::where('id', $value)
            ->select('three_pl_customer_id')
            ->first();

        $encodedThreePlCustId = ($threePlCustomerId) ? $threePlCustomerId->three_pl_customer_id : '';

        $threePlCustomerId = $this->decodeHashValue($encodedThreePlCustId);

        $isValidProduct = Vendor::where('id', $this->vendorId)
            ->where('three_pl_customer_id', $threePlCustomerId)
            ->count();

        if (! $isValidProduct) {
            $fail(trans('product::messages.invalid_product', ['attribute' => $attribute]));
        }
    }
}
