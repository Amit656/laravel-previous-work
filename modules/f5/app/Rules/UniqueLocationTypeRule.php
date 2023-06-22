<?php

namespace Modules\Location\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Modules\Location\App\Models\Location;

class UniqueLocationTypeRule implements ValidationRule
{
    private string $threePlId;

    private ?string $locationId;

    /**
     * construct
     *
     * @param  string  $threePlId
     * @param  ?string  $locationId
     */
    public function __construct(string $threePlId, ?string $locationId)
    {
        $this->threePlId = $threePlId;
        $this->locationId = $locationId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $locationId = $this->locationId;
        $existLocationType = Location::where('location_type_id', $value)
            ->where('three_pl_id', $this->threePlId)
            ->when($locationId, function ($query) use ($locationId) {
                return $query->whereNot('id', $locationId);
            })->count();
        if ($existLocationType) {
            $fail(trans('locationType::messages.validation.location_type_exists', ['attribute' => $attribute]));
        }
    }
}
