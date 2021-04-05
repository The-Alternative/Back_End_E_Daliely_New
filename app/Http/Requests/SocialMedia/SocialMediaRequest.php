<?php

namespace App\Http\Requests\SocialMedia;

use Illuminate\Foundation\Http\FormRequest;

class SocialMediaRequest extends FormRequest
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
            'phone_number'      =>'required|regex:/[0-9]{10}/',
            'whatsapp_number'   =>'required|regex:/[0-9]{10}/',
            'telegram_number'   =>'required|regex:/[0-9]{10}/',
        ];
    }
    public function messages()
    {
        return [
            'phone_number.required'=>'Please Enter Your  Phone Number',
            'whatsapp_number.required'=>'Please Enter Your  whatsapp Number',
            'telegram_number.required'=>'Please Enter Your  telegram Number',



        ];

            }

}
