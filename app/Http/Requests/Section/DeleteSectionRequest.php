<?php

namespace App\Http\Requests\Sections;

use Illuminate\Foundation\Http\FormRequest;

class DeleteSectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'=>'exists:sections,id'
        ];
    }
}
