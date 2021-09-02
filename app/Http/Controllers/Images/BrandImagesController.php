<?php

namespace App\Http\Controllers\Images;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BrandImagesController extends Controller
{
    public function upload(Request $request)
    {
        $image = $request->file('image');
        $folder = public_path('images/brands' . '/');
        $filename = time() . '.' . $image->getClientOriginalName();
        $imageUrl='images/brands' . '/' . $filename;

        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0775, true, true);
        }
        $request->image->move($folder,$filename);
        return $imageUrl;

    }
}
