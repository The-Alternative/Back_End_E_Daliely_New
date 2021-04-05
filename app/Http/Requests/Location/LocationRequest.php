<?php

<<<<<<< HEAD:app/Http/Requests/Location/LocationRequest.php
namespace App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
=======
namespace App\Http\Requests\Brands;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f:app/Http/Requests/Brands/BrandRequest.php
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
<<<<<<< HEAD:app/Http/Requests/Location/LocationRequest.php
            //
=======
            'name'=> 'require|min:5|max:255|unique:brands,name',
            'slug'=>'required',
            'description'=>'required|min:20|max:255',
            'image'=>'required',
            'is_active'=>'required',

>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f:app/Http/Requests/Brands/BrandRequest.php
        ];
    }
}
