<?php

namespace App\Http\Requests\Hospital;

use Illuminate\Foundation\Http\FormRequest;

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
            'name'=> 'required|min:5|max:255|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)+$/|unique:hospitals,name'
        ];

    }

    public function messages()
    {
        return [
            'name.required' => 'Please Enter Your Hospital\'s Name',
            'name.min' => 'Your Hospital\'s Name Is Too Short',
            'name.max' => 'Your Hospital\'s Name Is Too Long',
            'name.regex' => 'Your Hospital\'s Name Have Number',
            'name.unique' => 'This Name\'s Is Used By Another Hospital',

        ];
    }
}
