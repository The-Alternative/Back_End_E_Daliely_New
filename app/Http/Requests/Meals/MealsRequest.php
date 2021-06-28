<?php

namespace App\Http\Requests\Meals;

use Illuminate\Foundation\Http\FormRequest;

class MealsRequest extends FormRequest
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
            'meal_type_id'   =>'required',

            'meal'=>'required|array|min:1',
            'meal.*.title'=>'required|min:3|string',
            'meal.*.short_description'=>'required|min:10|max:255',
            'meal.*.long_description'=>'required|min:10|max:255',
            'meal.*.locale'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'required'=>'this field is required',
            'in'=>'this field must be 0 (is not active) or 1 (is active)',

            'meal.*.title.min' => 'Your meal\'s title  Is Too Short',

            'meal.*.short_description.min' => 'Your meal Description\'s Is Too Short',
            'meal.*.short_description.max' => 'Your meal Description\'s Is Too Short',

            'meal.*.long_description.min' => 'Your meal Description\'s Is Too Long',
            'meal.*.long_description.max' => 'Your meal Description\'s Is Too Long',
        ];
    }
}
