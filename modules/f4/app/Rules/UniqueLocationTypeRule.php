<?php

namespace Modules\Locationtype\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Modules\Locationtype\App\Models\LocationType;

class UniqueLocationTypeRule implements ValidationRule
{
    private string $threePlId;

    private ?string $locationTypeId;

    /**
     * construct
     *
     * @param  string  $threePlId
     * @param  ?string  $locationTypeId
     */
    public function __construct(string $threePlId, ?string $locationTypeId)
    {
        $this->threePlId = $threePlId;
        $this->locationTypeId = $locationTypeId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $locationTypeId = $this->locationTypeId;
        $existLocationType = LocationType::where('name', $value)
            ->where('three_pl_id', $this->threePlId)
            ->when($locationTypeId, function ($query) use ($locationTypeId) {
                return $query->whereNot('id', $locationTypeId);
            })->count();
        if ($existLocationType) {
            $fail(trans('locationType::messages.validation.location_type_exists', ['attribute' => $attribute]));
        }
    }
}
