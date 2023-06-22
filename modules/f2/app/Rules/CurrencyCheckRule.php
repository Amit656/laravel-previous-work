<?php

namespace Modules\Vendor\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Classes\Currency;

class CurrencyCheckRule implements ValidationRule
{
    /**
     * construct
     */
    public function __construct()
    {
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {        
        $currencyObj = new Currency;
        if (!array_key_exists($value,$currencyObj->currencyCodes())) {
            $fail(trans('vendor::messages.validation.invalid_currency', ['attribute' => $attribute]));
        }
    }
}