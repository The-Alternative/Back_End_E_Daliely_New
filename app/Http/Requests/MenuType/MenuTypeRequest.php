<?php

namespace App\Http\Requests\MenuType;

use Illuminate\Foundation\Http\FormRequest;

class MenuTypeRequest extends FormRequest
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

            'menuType'=>'required|array|min:1',
            'menuType.*.title'=>'required|min:3|string',
            'menuType.*.short_description'=>'required|min:10|max:255',
            'menuType.*.long_description'=>'required|min:10|max:255',
            'menuType.*.locale'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'required'=>'this field is required',
            'in'=>'this field must be 0 (is not active) or 1 (is active)',

            'menuType.*.title.min' => 'Your restaurantType\'s title  Is Too Short',

            'menuType.*.short_description.min' => 'Your menuType Description\'s Is Too Short',
            'menuType.*.short_description.max' => 'Your menuType Description\'s Is Too Short',

            'menuType.*.long_description.min' => 'Your menuType Description\'s Is Too Long',
            'menuType.*.long_description.max' => 'Your menuType Description\'s Is Too Long',



        ];
    }
}
