<?php

namespace App\Http\Controllers\Images;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\Input;

class StoreImagesController extends Controller
{
    public function upload(Request $request, $id)
    {
        $image = $request->file('image');
        $folder = public_path('images/stores' . '/' . $id . '/');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0775, true, true);
//             $location = storage_path('/app/public/images'  . '/' . 5 . '/' . $filename);
//            Image::make($image)->resize(800,400)->save($location); //resizing and saving the image
        }
        $request->image->move($folder, $filename);
        return [$folder, $filename];

    }

    public function uploadLogo(Request $request)
    {
        $image = $request->file('image');
        $folder = public_path('images/stores/logo' . '/');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0775, true, true);
//             $location = storage_path('/app/public/images'  . '/' . 5 . '/' . $filename);
//            Image::make($image)->resize(800,400)->save($location); //resizing and saving the image
        }
        $request->image->move($folder, $filename);
        return [$folder, $filename];

    }


    public function uploadMultiple(Request $request, $id)
    {
//        $files = Input::file('filename');
//        foreach ($files as $one) {
//            $filename       = $one->getClientOriginalName();
//            $listfilenames[] = $filename;
//        }
//        echo $listfilenames
//

//        return $request;

        if (!$request->hasFile('images')) {
            return response()->json(['upload_file_not_found'], 400);
        }

        $allowedfileExtension = ['pdf', 'jpg', 'png' ,'jpeg'];
        $files = $request->file('images');
        $errors = [];

        foreach ($files as $file) {
            $folder = public_path('images/stores/logo' . '/');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $extension = $file->getClientOriginalExtension();

             $check = in_array($extension, $allowedfileExtension);

            if ($check) {
                foreach ($request->images as $mediaFiles) {

                    $path = $mediaFiles->store('public/images');
                    $name = $mediaFiles->getClientOriginalName();
                    $mediaFiles->move($folder, $filename);
                    return [$folder, $filename];

                    //store image file into directory and db
//                    $save = new Image();
//                    $save->title = $name;
//                    $save->path = $path;
//                    $save->save();
                }
            } else {
                return response()->json(['invalid_file_format'], 422);
            }

            return response()->json(['file_uploaded'], 200);

        }





//        return $request;
//        return $images = $request->images;
//        foreach ($images as $ar) {
//            if (isset($image)) {
//                if ($request->hasFile($ar)) {
//                    $folder = public_path('images/stores/' . $id . '/');
//                    $filename = time() . '.' . $ar->getClientOriginalExtension();
//                    if (!File::exists($folder)) {
//                        File::makeDirectory($folder, 0775, true, true);
////             $location = storage_path('/app/public/images'  . '/' . 5 . '/' . $filename);
////            Image::make($image)->resize(800,400)->save($location); //resizing and saving the image
//                    }
//                }
//                $ar->move($folder, $filename);
//                return ['path', $folder, 'name', $filename];
//            }
//        }
    }

    }

