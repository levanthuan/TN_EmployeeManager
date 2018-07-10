<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class TimeOffRequest extends FormRequest
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
        $yesterday = Carbon::yesterday("Asia/Ho_Chi_Minh")->format("Y/m/d H:m:s");
        return [
            'start_time'    => 'required|after:'.$yesterday,
            'end_time'      => 'required|after:start_time',
            'reason'        => 'required',
        ];
    }

    public function messages()
    {
        return [
            'start_time.required'       => 'You must enter start time here.',
            'start_time.after'          => 'The start time must be greater than yesterday.',
            'end_time.required'         => 'You must enter end time here.',
            'end_time.after'            => 'The end time must be greater than start time.',
            'reason.required'           => 'You must enter reason here.',
        ];
    }
}
