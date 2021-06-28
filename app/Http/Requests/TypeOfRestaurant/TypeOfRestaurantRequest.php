<?php

namespace App\Http\Requests\TypeOfRestaurant;

use Illuminate\Foundation\Http\FormRequest;

class TypeOfRestaurantRequest extends FormRequest
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


            'typerestaurant'=>'required|array|min:1',
            'typerestaurant.*.title'=>'required|min:3|string',
            'typerestaurant.*.short_description'=>'required|min:10|max:255',
            'typerestaurant.*.long_description'=>'required|min:10|max:255',
            'typerestaurant.*.locale'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'required'=>'this field is required',
            'in'=>'this field must be 0 (is not active) or 1 (is active)',

            'typerestaurant.*.title.min' => 'Your restaurant\'s type title  Is Too Short',

            'typerestaurant.*.short_description.min' => 'Your restaurant type Description\'s Is Too Short',
            'typerestaurant.*.short_description.max' => 'Your restaurant type Description\'s Is Too Short',

            'typerestaurant.*.long_description.min' => 'Your restaurant type Description\'s Is Too Long',
            'typerestaurant.*.long_description.max' => 'Your restaurant type Description\'s Is Too Long',



        ];
    }
}
