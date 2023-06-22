<?php

namespace Modules\Location\App\Rules;

use App\Helpers\StUtility;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Modules\Location\App\Models\Location;

class UniqueLocationRule implements ValidationRule
{
    private string $threePlId;

    private ?string $locationId;

    /**
     * construct
     *
     * @param  string  $threePlId
     * @param  ?string  $locationId
     */
    public function __construct(?string $locationId)
    {
        $this->threePlId = \AuthUtility::getThreePlIdFor3PlAndStaff(Auth::user());
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
        $existLocation = Location::where('name', $value)
            ->where('three_pl_id', $this->threePlId)
            ->when($locationId, function ($query) use ($locationId) {
                return $query->whereNot('id', $locationId);
            })->count();
        if ($existLocation) {
            $fail(trans('location::messages.validation.location_exists', ['attribute' => $attribute]));
        }
    }
}
