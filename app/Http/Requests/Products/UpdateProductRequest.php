<?php

namespace App\Http\Requests\Products;

use App\Models\product;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        return array_merge(product::rules(),[
            'id'=>'exists:products,id'
        ]);
    }
    public function messages()
    {
        return product::messages();
      
    }
}
