<?php

namespace App\Http\Requests\Meun;

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

            'Menu'=>'required|array|min:1',
            'Menu.*.name'=>'required|min:3|string',
            'Menu.*.short_description'=>'required|min:10|max:255',
            'Menu.*.long_description'=>'required|min:10|max:255',
            'Menu.*.locale'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'required'=>'this field is required',
            'in'=>'this field must be 0 (is not active) or 1 (is active)',

            'Menu.*.name.min' => 'Your Menu\'s name  Is Too Short',

            'Menu.*.short_description.min' => 'Your Menu Description\'s Is Too Short',
            'Menu.*.short_description.max' => 'Your Menu Description\'s Is Too Short',

            'Menu.*.long_description.min' => 'Your Menu Description\'s Is Too Long',
            'Menu.*.long_description.max' => 'Your Menu Description\'s Is Too Long',



        ];
    }
}
