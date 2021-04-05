<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Stores\Store;

class StoreRequest extends FormRequest
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
            'title'          =>'required|min:5|max:255|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)+$/|unique:stores,title',
            'phone_number'   =>'required|regex:/[0-9]{10}/',
           // 'business_email' =>'required|business_email|unique:stores',
            //'logo'           =>'required|logo:stores',
            //'address'        =>'required|address:stores',
           // 'location'       =>'required|location:stores',
        ];
    }

    public function messages()
    {
        return [

            'title.required'=>'Please Enter Your Store\'s Name',
            'title.min'=>'Your store\'s Name Is Too Short',
            'title.max'=>'Your store\'s Name Is Too Long',
            //'title.regex'=>'Your Store\'s Name Have Number',
            'title.unique'=>'This Name\'s Is Used By Another Store',
            'phone_number.required'=>'Please Enter Your Store\'s Phone Number',

            //'business_email.required'=>'Please Enter Your Store\'s Business Email',
           // 'logo.required'=>'Please Enter Your Store\'s Logo',
            //'location.required'=>'Please Enter Your Store\'s Location',
            //'address.required'=>'Please Enter Your Store\'s address'

        ];
    }
}
