<?php

namespace App\Http\Requests\PostStore;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'post_id' =>'required',
            'store_id'   =>'required',
            'start_date_time' =>'required',
            'end_date_time'   =>'required',
            'price'   =>'required',
            'new_price'   =>'required',
            'is_active'  =>'required|in:0,1',
            'is_approved'=>'required|in:0,1',
        ];
    }
    public function messages()
    {
        return[
            'required'=>'this field is required',
            'in'=>'this field must be 0 (is not active) or 1 (is active)',
        ];
    }
}
