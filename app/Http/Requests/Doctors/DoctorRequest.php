<?php

namespace App\Http\Requests\Doctors;

use Facade\FlareClient\Context\RequestContext;
use Illuminate\Foundation\Http\FormRequest;
//use App\Models\Doctors\DoctorTranslation;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
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
            'is_active'=>'required',
            'doctor'=>'required|array|min:1',
            'doctor.*.first_name'=>'required|min:3',
            'doctor.*.last_name'=>'required',
            'doctor.*.address'=>'required',
//                'doctor'=>'required|array',
//                'doctor.*'=>'required|min:5',
//                'doctor.first_name' =>'required|min:3|max:255|regex:/^([a-zA-Z]+)/|unique:doctor_translation,first_name',
//                'doctor.last_name' =>'required|min:3|max:255|regex:/^([a-zA-Z]+)/|unique:doctor_translation,last_name',
//                'doctor.description' =>'required|min:10|max:255:doctor_translation',
//                'doctor.image' => 'required:doctors',
            ];
//

    }
//    public function messages()
//    {
//        return [
//            'first_name.required' => 'Please Enter Your Doctor\'s First Name',
//            'first_name.min' => 'Your Doctor\'s First Name Is Too Short',
//            'first_name.max' => 'Your Doctor\'s First Name Is Too Long',
//            'first_name.regex' => 'Your Doctor\'s First Name Have Number',

//            'last_name.required' => 'Please Enter Your Doctor\'s  Last Name',
//            'last_name.min' => 'Your Doctor\'s Last Name Is Too Short',
//            'last_name.max' => 'Your Doctor\'s Last Name Is Too Long',
//            'last_name.regex' => 'Your Doctor\'s Last Name Have Number',

//            'description.required' => 'Please Enter Your Doctor\'s Description',
//            'Description.min' => 'Your Doctor Description\'s Is Too Short',
//            'description.max' => 'Your Doctor Description\'s Is Too Long',

//            'image.required' => 'Please Enter Your Doctor\'s Image',
//        ];
//    }
}
