<?php

namespace App\Http\Requests\Menus;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'menu_type_id'   =>'required',
            'restaurant_id'   =>'required',

            'menu'=>'required|array|min:1',
            'menu.*.title'=>'required|min:3|string',
            'menu.*.short_description'=>'required|min:10|max:255',
            'menu.*.long_description'=>'required|min:10|max:255',
            'menu.*.locale'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'required'=>'this field is required',
            'in'=>'this field must be 0 (is not active) or 1 (is active)',

            'menu.*.title.min' => 'Your menu\'s title  Is Too Short',

            'menu.*.short_description.min' => 'Your menu Description\'s Is Too Short',
            'menu.*.short_description.max' => 'Your menu Description\'s Is Too Short',

            'menu.*.long_description.min' => 'Your menu Description\'s Is Too Long',
            'menu.*.long_description.max' => 'Your menu Description\'s Is Too Long',
       ];
    }
}
