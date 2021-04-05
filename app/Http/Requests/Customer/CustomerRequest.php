<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Customer\Customer;
use Illuminate\Support\Facades\Validator;


class CustomerRequest extends FormRequest
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
        return[
             'is_active'=>'required',
             'customer'=>'required|array|min:1',
             'customer.*.first_name'=>'required|min:3',
             'customer.*.last_name'=>'required|min:3',
             'customer.*.address'=>'required|min:3',
//            'customer.*.first_name'=>'required|min:3|max:100|regex:/^([a-zA-Z]+)/|unique:customer_translations,first_name',
//            'customer.*.last_name'=>'required|min:3|max:100|regex:/^([a-zA-Z]+)/|unique:customer_translations,last_name',
//            'customer.*.address'=>'required|min:3|max:100|regex:/^([a-zA-Z]+)/|unique:customer_translations,address',
     ];
    }

    public function  messages()
    {
        return[
          'is_active.required'=>'this is required',
          'first_name.required'=>'this is required',
          'first_name.min'=>'this is short',

        ];
    }
}
