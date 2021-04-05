<?php

namespace App\Http\Requests\MedicalDevice;

use Illuminate\Foundation\Http\FormRequest;

class MedicalDeviceRequest extends FormRequest
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
//            'name'=> 'required|min:5|max:255|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)+$/|unique:medical_devices,name'

        ];
    }
    public function messages()
    {
        return [
//            'name.required' => 'Please Enter Your medical Device\'s Name',
//            'name.min' => 'Your medical Device\'s Name Is Too Short',
//            'name.max' => 'Your medical Device\'s Name Is Too Long',
//            'name.regex' => 'Your medical Device\'s Name Have Number',
//            'name.unique' => 'This Name\'s Is Used By Another medical Device',

        ];
    }
}
