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
            'is_active'=>'required|in:0,1',
            'images'=>'array|min:1',
            'slug'=>'required',

            'category'=>'required|array|min:1',
            'category.*.name'=>'required|min:3|string',
        ];
    }

    public function messages()
    {
        return [
            'required'=>'this field is required',
            'in'=>'this field must be 0 (is not active) or 1 (is active)',


            'name.min'=>'Your Category\'s name Is Too Short',
            'name.max'=>'Your Category\'s name Is Too Long',
//            'name.unique'=>'This name\'s Is Used By Another Category',

            'slug.min'=>'Your Category\'s Slug Is Too Short ',
            'slug.max'=>'Your Category\'s Slug Is Too Long',

        ];
    }
}
