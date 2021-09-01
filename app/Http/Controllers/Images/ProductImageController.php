<?php

namespace App\Http\Controllers\Images;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductImageController extends Controller
{
    public function upload(Request $request,$id)
    {
        $image = $request->file('image');
        $folder = public_path('images/products' . '/' . $id . '/');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0775, true, true);
//             $location = storage_path('/app/public/images'  . '/' . 5 . '/' . $filename);
//            Image::make($image)->resize(800,400)->save($location); //resizing and saving the image
        }
        $request->image->move($folder,$filename);
        return [$folder,$filename];

    }
}
