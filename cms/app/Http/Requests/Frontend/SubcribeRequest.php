<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class SubcribeRequest extends FormRequest
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
            'name' => 'required|min:1',
            'number' => 'required|regex:/^[+]*[(]{0,1}[0-9\+]{1,4}[)]{0,1}[0-9\s]*$/|unique:subscribe,number|min:8|max:14',
            'email' => 'required|email|unique:subscribe,email'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'email.required' => 'Email is required!',
            'number.required' => 'Phone is required!',
            'number.min' => 'Phone numbers must be at least 8 digits',
            'number.regex' => 'Phone numbers format is invalid',
            'number.max' => 'Maximum phone numbers is 14 digits',
            'number.unique' => 'Phone number is exists',
            'email.email' => 'Email must be in correct email format',
            'email.unique' => 'Email is exists'
        ];
    }
}
