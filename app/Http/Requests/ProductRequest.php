<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Products\Product;

class ProductRequest extends FormRequest
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
            // 'title_ar' => 'required|min:3|max:50|unique:products',
            // 'title_en' => 'required|min:3|max:50|unique:products',
            // 'slug_ar' => 'required|min:3|max:50:products',
            // 'slug_en' => 'required|min:3|max:50:products',
            // 'brand_id' => 'required:products',
            // 'barcode' => 'required|unique:products',
            // 'meta_ar' => 'required|min:3|max:50:products',
            // 'meta_en' => 'required|min:3|max:50:products',
            // 'short_des_ar' => 'required|min:5|max:250:products',
            // 'short_des_en' => 'required|min:5|max:250:products',
            // 'description_ar' => 'required|min:5|max:500:products',
            // 'description_en' => 'required|min:5|max:500:products',
            //'image ' => 'required_without:id |mimes:png,jpg,jpeg:products'

        ];
    }
    public function messages()
    {
        return [
            // 'title_ar.required'=>__('message.Please Enter Your Product\'s Title'),
            // 'title_ar.min'=>__('message.Your Product\'s Title Is Too Short'),
            // 'title_ar.max'=>__('message.Your Product\'s Title Is Too Long'),
            // 'title_ar.unique'=>__('message.This Title\'s Is Used By Another Product'),

            // 'title_en.required'=>__('message.Please Enter Your Product\'s Title'),
            // 'title_en.min'=>__('message.Your Product\'s Title Is Too Short'),
            // 'title_en.max'=>__('message.Your Product\'s Title Is Too Long'),
            // 'title_en.unique'=>__('message.This Title\'s Is Used By Another Product'),

            // 'slug_ar.required'=>__('message.Please Enter Your Product\'s Slug'),
            // 'slug_ar.min'=>__('message.Your Product\'s Slug Is Too Short '),
            // 'slug_ar.max'=>__('message.Your Product\'s Slug Is Too Long'),

            // 'slug_en.required'=>__('message.Please Enter Your Product\'s Slug'),
            // 'slug_en.min'=>__('message.Your Product\'s Slug Is Too Short '),
            // 'slug_en.max'=>__('message.Your Product\'s Slug Is Too Long'),

            // 'brand_id.required'=>__('message.Please Secify The Brand'),
            // 'barcode.required'=>__('message.Please Enter Your Product\'s Barcode'),
            // 'barcode.unique'=>__('message.This Barcode\'s Is Used By Another Product'),

            // 'short_des_ar.required'=>__('message.Please..Enter Your Product\'s Short Description'),
            // 'short_des_ar.min'=>__('message.Your Product Description\'s Is Too Short'),
            // 'short_des_ar.max'=>__('message.Your Product Description\'s Is Too Long'),

            // 'short_des_en.required'=>__('message.Please..Enter Your Product\'s Short Description'),
            // 'short_des_en.min'=>__('message.Your Product Description\'s Is Too Short'),
            // 'short_des_en.max'=>__('message.Your Product Description\'s Is Too Long'),

            // 'meta_ar.required'=>__('message.Please Enter Your Product\'s Meta'),
            // 'meta_ar.min'=>__('message.Your Product\'s Meta Is Too Short'),
            // 'meta_ar.max'=>__('message.Your Product\'s Meta Is Too Long'),

            // 'meta_en.required'=>__('message.Please Enter Your Product\'s Meta'),
            // 'meta_en.min'=>__('message.Your Product\'s Meta Is Too Short'),
            // 'meta_en.max'=>__('message.Your Product\'s Meta Is Too Long'),

            // 'description_ar.required'=>__('message.Please Enter Your Product\'s Description'),
            // 'description_ar.min'=>__('message.Your Product Description\'s Is Too Short'),
            // 'description_ar.max'=>__('message.Your Product Description\'s Is Too Long'),

            // 'description_en.required'=>__('message.Please Enter Your Product\'s Description'),
            // 'description_en.min'=>__('message.Your Product Description\'s Is Too Short'),
            // 'description_en.max'=>__('message.Your Product Description\'s Is Too Long'),
        ];
    }
}
