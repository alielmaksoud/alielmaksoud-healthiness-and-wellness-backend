<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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


            'name' => 'required|min:3|max:200',
            'description' => 'required|max:500',
            'category_id'=>'required|integer',
            'is_event'=>'boolean',
            'is_program'=>'boolean',
            'is_class'=>'boolean',
            'is_blog'=>'boolean', 

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'name.min:3'=>'Name cannot be less than three letters',
            'name.max:5'=>"Exceeded space allowed",

            'description.required' => 'Description is required!',
            'description.max:500'=>'Exceeded space allowed',

          

            'category_id.required'=>'Category id id is required',
            'category_id.integer'=>'Category id should be an integer',
            
            'is_event.boolean' => 'This should be true, false, 0, or 1',
            'is_class.boolean' => 'This should be true, false, 0, or 1',
            'is_program.boolean' => 'This should be true, false, 0, or 1',
            'is_blog.boolean' => 'This should be true, false, 0, or 1',

        ];
    }
}