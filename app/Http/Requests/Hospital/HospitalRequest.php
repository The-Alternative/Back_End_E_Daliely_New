<?php

namespace App\Http\Requests\Hospital;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class HospitalRequest extends FormRequest
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
             'is_active'       =>'required|in:0,1',
             'is_approved,'    =>'required|in:0,1',
             'medical_center'  =>'required',
             'general_hospital'=>'required',
             'private_hospital'=>'required',
             'location_id'     =>'required',
             'doctor_id'       =>'required',


            'name'=> 'required|min:5|max:255|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)+$/|unique:hospitals,name'
        ];

    }

    public function messages()
    {
        return [
            'required'=>'this field is required',
            'in'=>'this field must be 0 (is not active) or 1 (is active)',

            'name.min' => 'Your Hospital\'s Name Is Too Short',
            'name.max' => 'Your Hospital\'s Name Is Too Long',
            'name.regex' => 'Your Hospital\'s Name Have Number',
            'name.unique' => 'This Name\'s Is Used By Another Hospital',

        ];
    }
}
