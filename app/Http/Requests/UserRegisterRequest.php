<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            /* 'image'=>'required|mimes:jpeg,png,jpg,gif,svg|max:2048', */
            'first_name' => 'required|between:2,100',
            'last_name' => 'required|between:2,100',
            'email' => 'required|email|unique:users|max:50',
            'password' => 'required|string|min:6',
            'phone' => ['required', 'regex:/^((961[\s+-]*(3|7(0|1)))|(03|7(0|1))|(81|7(6|8))|(79))[\s+-]*\d{6}$/u'],
        ];
    }
    public function messages()
    {
        return [
            'first_name.required'=>'Your First Name is Required!',
            'last_name.required'=>'Your Last Name is Required!',
            'email.required'=>'An email is required!',
            'password.required'=>'A password is required!',
            'phone.required'=>'A phone number is required!',
            /* 'image.required' => 'Image is required!',
            'image.mimes:jpeg,png,jpg,gif,svg|max:2048' => 'Imageshould be in the right format!', */

        ];
    }
}