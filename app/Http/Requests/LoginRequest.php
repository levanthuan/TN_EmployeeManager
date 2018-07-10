<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email'         => 'required|email',
            'password'      => 'required|min:6|max:32',
        ];
    }
    public function messages()
    {
        return [
            'email.required'            => 'You must enter an email address here.',
            'email.email'               => 'Invalid email address.',
            'password.required'         => 'Enter a password.',
            'password.min'              => 'Password must be at least 6 characters.',
            'password.max'              => 'Password is not more than 32 characters.',            
        ];
    }    
}
