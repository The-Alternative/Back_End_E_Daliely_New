<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Customer\Customer;
use Illuminate\Support\Facades\Validator;
use Facade\FlareClient\Context\RequestContext;

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
            'is_active'=>'required|in:1,0',
            'is_approved'=>'required|in:1,0',
            'social_media_id'=>'required',

            'customer'=>'required|array|min:1',
            'customer.*.first_name'=>'required|min:3|max:100',
            'customer.*.last_name'=>'required|min:3|max:100',
            'customer.*.address'=>'required|min:10|max:255',
            'customer.*.locale'=>'required',
            'customer.*.customer_id'=>'required',
     ];
    }

    public function  messages()
    {
        return[

            'required'=>'this field is required',
            'in'=>'this field must be 0 (is not active) or 1 (is active)',

            'customer.*.first_name.min' => 'Your Customer\'s First Name Is Too Short',
            'customer.*.first_name.max' => 'Your Customer\'s First Name Is Too Long',

            'customer.*.last_name.min' => 'Your Customer\'s Last Name Is Too Short',
            'customer.*.last_name.max' => 'Your Customer\'s Last Name Is Too Long',

            'customer.*.address.min' => 'Your Customer address\'s Is Too Short',
            'customer.*.address.max' => 'Your Customer address\'s Is Too Long',

        ];
    }
}
