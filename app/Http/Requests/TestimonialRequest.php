<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            /* 'image'=>'required|mimes:jpeg,png,jpg,gif,svg|max:2048', */
            'content' => 'required|max:500',
        ];
    }
    public function message()
    {
        return [
            'name.required' => 'Name is required!',
            'name.min:3'=>'Name cannot be less than three letters',
            'name.max:255'=>"Exceeded space allowed",
            
           /*  'image.required' => 'Image is required!',
            'image.mimes:jpeg,png,jpg,gif,svg|max:2048' => 'Image should be in the right format!',
             */
            'content.required' => 'Content required!',
            'content.max:500'=>'Exceeded space allowed',
        ];
    }
}