<?php

namespace App\Http\Requests\Section;

use App\Models\section;
use Illuminate\Foundation\Http\FormRequest;

class StoreSectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return section::rules();
    }
    public function messages()
    {
        return section::messages();
    }
}
