<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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

            'Post'=>'required|array|min:1',
            'Post.*.name'=>'required|min:3|string',
            'Post.*.short_description'=>'required|min:10|max:255',
            'Post.*.long_description'=>'required|min:10|max:255',
            'Post.*.locale'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'required'=>'this field is required',
            'in'=>'this field must be 0 (is not active) or 1 (is active)',

            'Post.*.name.min' => 'Your Post\'s name  Is Too Short',

            'Post.*.short_description.min' => 'Your Post Description\'s Is Too Short',
            'Post.*.short_description.max' => 'Your Post Description\'s Is Too Short',

            'Post.*.long_description.min' => 'Your Post Description\'s Is Too Long',
            'Post.*.long_description.max' => 'Your Post Description\'s Is Too Long',


        ];
    }
}
