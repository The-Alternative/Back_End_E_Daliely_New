<?php

namespace App\Http\Requests\Specialty;

use Illuminate\Foundation\Http\FormRequest;

class SpecialtyRequest extends FormRequest
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
//            'name'=> 'required|min:3|max:255|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)+$/|unique:specialties,name'

        ];
    }
    public function messages()
    {
        return [
//            'name.required' => 'Please Enter Your specialty\'s Name',
//            'name.min' => 'Your specialty\'s Name Is Too Short',
//            'name.max' => 'Your specialty\'s Name Is Too Long',
//            'name.regex' => 'Your specialty\'s Name Have Number',
//            'name.unique' => 'This Name\'s Is Used By Another specialty',
            ];
    }
}
