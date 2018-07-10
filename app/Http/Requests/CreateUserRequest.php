<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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

    public function rules()
    {
        return [
            'fullname' => 'required',
            'password' => 'required|alpha_dash|min:6|max:30',
            'repassword' => 'required|same:password',
            'email' => 'required|email|unique:users,email',
        ];
    }

    public function messages()
    {
        return [
            'password.required'         => 'You must enter a password here.',
            'password.min'              => 'Password must be at least 6 characters.',
            'password.max'              => 'Password is not more than 30 characters.',
            'repassword.required'       => 'You must enter a confirm password here.',
            'repassword.same'           => 'Password and confirm password do not match.',
            'email.required'            => 'You must enter an email address here.',
            'email.email'               => 'Invalid email address.',
            'email.unique'              => 'Email can not be duplicated!'       
        ];
    }
}