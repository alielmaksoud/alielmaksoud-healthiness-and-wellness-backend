<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        return [
            'category_name' => 'required|min:3|max:255',
            'description'=>'max:500',
        ];
    }
    public function messages()
    {
        return [
            'category_name.required' => 'Category is required!',
            'category_name.min:3'=>'Name cannot be less than three letters',
            'category_name.max:255'=>"Exceeded space allowed",
            'description.max:500'=>'Exceeded space allowed',
            
        ];
    }
}