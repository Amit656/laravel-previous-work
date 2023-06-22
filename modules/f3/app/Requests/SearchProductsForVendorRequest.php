<?php

namespace Modules\Product\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchProductsForVendorRequest extends FormRequest
{
    /**
     *
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'search' => 'string|max:50',
        ];
    }
}
