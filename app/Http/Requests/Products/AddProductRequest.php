<?php

namespace App\Http\Requests\Products;

use App\Models\product;
use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
        return product::rules();
    }
    public function messages()
    {
        return product::messages();
    }
}
