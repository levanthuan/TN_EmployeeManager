<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'email' => 'required|nullable|email|unique:users,email,'.$this->id,
            'gender' => 'nullable|in:Male,FeMale',
            'phone_number' => 'nullable|min:900000000|max:1999999999|numeric',
            'birth_day' => 'nullable|before:now',
        ];
    }

    public function messages()
    {
        return [
            'email.required'            => 'You must enter an email address here.',
            'email.email'               => 'Invalid email address.',
            'email.unique'              => 'Email can not be duplicated!',
            'phone_number.min'          => 'Invalid phone number',
            'phone_number.max'          => 'Invalid phone number',
        ];
    }
}
