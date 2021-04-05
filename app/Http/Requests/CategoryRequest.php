<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Categories\Category;

class CategoryRequest extends FormRequest
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
//
//            'name' => 'required|min:3|max:50|unique:categories',
//            'slug' => 'required|min:3|max:50:categories',
//            'parent_id' => 'required:categories',
//            'image' => 'required:categories'
        ];
    }
    public function messages()
    {
        return [
//            'name.required'=>'Please Enter Your Category\'s name',
//            'name.min'=>'Your Category\'s name Is Too Short',
//            'name.max'=>'Your Category\'s name Is Too Long',
//            'name.unique'=>'This name\'s Is Used By Another Category',
//            'slug.required'=>'Please Enter Your Product\'s Slug',
//            'slug.min'=>'Your Category\'s Slug Is Too Short ',
//            'slug.max'=>'Your Category\'s Slug Is Too Long',
//            'parent.required'=>'Please Specify The parent'
        ];
    }
}
