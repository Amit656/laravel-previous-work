<?php

namespace Modules\Locationtype\App\Requests;

use App\Helpers\StUtility;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Modules\Locationtype\App\Rules\UniqueLocationTypeRule;

class StoreLocationTypeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:30',
                new UniqueLocationTypeRule(\AuthUtility::getThreePlIdFor3PlAndStaff(Auth::user()), $this->locationtype->id ?? null),
            ],

        ];
    }
}
