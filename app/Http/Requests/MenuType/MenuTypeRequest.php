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

            'MenuType'=>'required|array|min:1',
            'MenuType.*.title'=>'required|min:3|string',
            'MenuType.*.short_description'=>'required|min:10|max:255',
            'MenuType.*.long_description'=>'required|min:10|max:255',
            'MenuType.*.locale'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'required'=>'this field is required',
            'in'=>'this field must be 0 (is not active) or 1 (is active)',

            'MenuType.*.title.min' => 'Your restaurantType\'s title  Is Too Short',

            'MenuType.*.short_description.min' => 'Your menuType Description\'s Is Too Short',
            'MenuType.*.short_description.max' => 'Your menuType Description\'s Is Too Short',

            'MenuType.*.long_description.min' => 'Your menuType Description\'s Is Too Long',
            'MenuType.*.long_description.max' => 'Your menuType Description\'s Is Too Long',



        ];
    }
}
