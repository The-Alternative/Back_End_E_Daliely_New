<?php

namespace App\Http\Controllers\Images;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;

class CategoryImagesController extends Controller
{
    public function upload(Request $request)
    {
        $image = $request->file('image');
        $folder = public_path('images/categories' . '/');
        $filename = time() . '.' . $image->getClientOriginalName();
        $imageUrl='images/categories' . '/' . $filename;
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0775, true, true);
        }
        $image->move($folder,$filename);
        return $imageUrl;
    }

}
