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
        $filename = time() . '.' . $image->getClientOriginalName();
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0775, true, true);
        }
        $image->move($folder,$filename);
        return [$folder,$filename];
    }

    public function uploadMultiple(Request $request, $id)
    {
        if (!$request->hasFile('images')) {
            return response()->json(['not found the files'], 400);
        }
        $files = $request->file(['images']);
        $errors = [];
        $folder = public_path('images/products' . '/' . $id . '/');
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0775, true, true);
        }
        foreach ($files as $file) {
            $filename[] = time() . '.' . $file->getClientOriginalName() ;

            $file->move($folder,  time() . '.' . $file->getClientOriginalName() );
        }
        return [$folder, $filename];

    }
}
