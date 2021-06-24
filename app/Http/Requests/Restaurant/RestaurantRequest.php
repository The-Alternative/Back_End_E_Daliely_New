<?php

namespace App\Http\Requests\Restaurant;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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
            'social_media_id'=>'required',
            'appointment_id' =>'required',
            'customer_id'   =>'required',
            'location_id'    =>'required',
            'type_of_restaurant_id'  =>'required',
            'food_id'              =>'required',
            'active_time_id'      =>'required',

            'restaurant'=>'required|array|min:1',
            'restaurant.*.title'=>'required|min:3|string',
            'restaurant.*.description'=>'required|min:10|max:255',
            'restaurant.*.locale'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'required'=>'this field is required',
            'in'=>'this field must be 0 (is not active) or 1 (is active)',

            'restaurant.*.title.min' => 'Your Doctor\'s First Name Is Too Short',

            'restaurant.*.Description.min' => 'Your Doctor Description\'s Is Too Short',
            'restaurant.*.description.max' => 'Your Doctor Description\'s Is Too Long',

        ];
    }
}
