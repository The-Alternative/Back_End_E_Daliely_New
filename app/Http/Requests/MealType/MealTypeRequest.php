<?php

namespace App\Http\Requests\MealType;

use Illuminate\Foundation\Http\FormRequest;

class MealTypeRequest extends FormRequest
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

            'mealType'=>'required|array|min:1',
            'mealType.*.title'=>'required|min:3|string',
            'mealType.*.short_description'=>'required|min:10|max:255',
            'mealType.*.long_description'=>'required|min:10|max:255',
            'mealType.*.locale'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'required'=>'this field is required',
            'in'=>'this field must be 0 (is not active) or 1 (is active)',

            'mealType.*.title.min' => 'Your meal Type\'s title  Is Too Short',

            'mealType.*.short_description.min' => 'Your meal Type Description\'s Is Too Short',
            'mealType.*.short_description.max' => 'Your meal Type Description\'s Is Too Short',

            'mealType.*.long_description.min' => 'Your meal Type Description\'s Is Too Long',
            'mealType.*.long_description.max' => 'Your meal Type Description\'s Is Too Long',



        ];
    }
}
