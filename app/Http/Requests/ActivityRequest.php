<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
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
            'activity' => 'required|min:3|max:255',
        ];
    }
    public function messages()
    {
        return [
            'activity.required' => 'Activity is required!',
            'activity.min:3'=>'Activity cannot be less than three letters',
            'activity.max:255'=>"Exceeded space allowed",

            
        ];
    }
}