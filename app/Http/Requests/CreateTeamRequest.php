<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTeamRequest extends FormRequest
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
            'name' => 'required',
            'division' => 'required',
            'description' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'   => 'You must enter a name.',
            'division.required'   => 'You must choose a division.',
            'description.required'   => 'Write something about your team.',
        ];
    }
}
