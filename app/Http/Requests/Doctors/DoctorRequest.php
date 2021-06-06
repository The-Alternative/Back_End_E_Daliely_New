<?php

namespace App\Http\Requests\Doctors;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
            'is_active'      =>'required|in:0,1',
            'is_approved'    =>'required|in:0,1',
            'image'          =>'required',
            'social_media_id'=>'required',
            'appointments_id'=>'required',
            'specialty_id'   =>'required',
            'hospital_id'    =>'required',
            'clinic_id'      =>'required',


            'doctor'=>'required|array|min:1',
            'doctor.*.first_name'=>'required|min:3|string',
            'doctor.*.last_name'=>'required|min:3',
            'doctor.*.description'=>'required|min:10|max:255',
            'doctor.*.locale'=>'required',
//            'doctor.*.doctor_id'=>'required'
            ];
    }
    public function messages()
    {
        return [
            'required'=>'this field is required',
            'in'=>'this field must be 0 (is not active) or 1 (is active)',

            'doctor.*.first_name.min' => 'Your Doctor\'s First Name Is Too Short',
            'doctor.*.first_name.max' => 'Your Doctor\'s First Name Is Too Long',

            'doctor.*.last_name.min' => 'Your Doctor\'s Last Name Is Too Short',
            'doctor.*.last_name.max' => 'Your Doctor\'s Last Name Is Too Long',

            'doctor.*.Description.min' => 'Your Doctor Description\'s Is Too Short',
            'doctor.*.description.max' => 'Your Doctor Description\'s Is Too Long',

        ];
    }
}
