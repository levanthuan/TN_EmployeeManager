<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFieldRequest extends FormRequest
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
            'name'         => 'required',
            'type'      => 'required', 
        ];
    }

    public function messages()
    {
        return [
            'name.required'            => 'You must enter an name field here.',
            'type.required'         => 'You must enter an type field here.',     
        ];
    }
}
