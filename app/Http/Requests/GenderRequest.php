<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenderRequest extends FormRequest
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
            'gender' => 'required|min:3|max:255',
        ];
    }
    public function messages()
    {
        return [
            'gender.required' => 'Gender is required!',
            'gender.min:3'=>'Gender cannot be less than three letters',
            'gender.max:255'=>"Exceeded space allowed",

            
        ];
    }
}