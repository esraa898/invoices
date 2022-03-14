<?php

namespace App\Http\Requests\Section;

use App\Models\section;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSectionRequest extends FormRequest
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

    /**n  
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      return [
         'id'=>'required|exists:sections',
        'section_name'=>'required|max:200|unique:sections,section_name,id',
        'description'=>'required|max:200',
                      ]  ;
       
    }
    public function messages()
    {
        return section::messages();
    }
}
