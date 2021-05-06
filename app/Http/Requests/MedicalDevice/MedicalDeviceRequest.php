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
            'is_active'  =>'required|in:1,0',
            'is_approved'=>'required|in:1,0',
            'doctor_id'=>'required',
            'hospital_id'=>'required',


            'MedicalDevice'=>'required|array|min:1',
            'MedicalDevice.*.name'=> 'required|min:5|max:255|unique',
            'MedicalDevice.*.locale'=> 'required',
            'MedicalDevice.*.medical_device_id'=> 'required',
        ];
    }
    public function messages()
    {
        return [

            'required'=>'this field is required',
            'in'=>'this field must be 0 (is not active) or 1 (is active)',

            'MedicalDevice.*.name.min' => 'Your medical Device\'s Name Is Too Short',
            'MedicalDevice.*.name.max' => 'Your medical Device\'s Name Is Too Long',
            'MedicalDevice.*.name.unique' => 'This Name\'s Is Used By Another medical Device',

        ];
    }
}
