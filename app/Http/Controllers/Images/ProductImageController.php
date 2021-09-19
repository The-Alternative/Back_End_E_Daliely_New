<?php

namespace App\Http\Controllers\Images;

use App\Http\Controllers\Controller;
use App\Models\Images\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductImageController extends Controller
{
    public function upload(Request $request,$id)
    {
        $image = $request->file('image');
        $folder = public_path('images/products' . '/' . $id . '/');
        $filename = time() . '.' . $image->getClientOriginalName();
        $imageUrl[]='images/products/' . $id  . '/' .  $filename;
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0775, true, true);
        }
        $image->move($folder,$filename);
        return $imageUrl;
    }

    public function uploadMultiple(Request $request, $id)
    {
        if (!$request->hasFile('images')) {
            return response()->json(['not found the files'], 400);
        }
        $files = $request->file(['images']);
        $folder = public_path('images/products' . '/' . $id . '/');
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0775, true, true);
        }
        foreach ($files as $file) {
            $filename[] = time() . '.' . $file->getClientOriginalName() ;
            $file->move($folder,  time() . '.' . $file->getClientOriginalName() );
        }
        foreach ($filename as $f) {
            $imageUrl[]='images/products/' . $id  . '/' .  $f;
        }
        return $imageUrl;
    }

    public function update_uploadMultiple(Request $request, $id)
    {
        if (!$request->hasFile('images')) {
            return response()->json(['not found the files'], 400);
        }
        $files = $request->file(['images']);
        $images_count=count($files);
        $folder = public_path('images/products' . '/' . $id . '/');
        foreach ($files as $file) {
            $filename[] = time() . '.' . $file->getClientOriginalName();
            $file->move($folder, time() . '.' . $file->getClientOriginalName());
        }
        foreach ($filename as $f) {
            $imageUrl[] = $id . '/' . $f;
        }
//        return $imageUrl;
        $old_images = $request->old_images;
        foreach ($old_images as $old_image) {
            $old = public_path('images/products' . '/' . $old_image);
            if (File::exists($old)) {
                unlink($old);
            }
        }
        $images = ProductImage::where('product_id', $id)->get();
        $imagesdb_count = count($images);
        if (is_null($images)) {
            return $this->returnSuccessMessage('This product not found', 'done');
        }
        for ($i = 1; $i <$imagesdb_count; $i++) {
        foreach ($images as $image) {
//            for ($j = 1; $j <= $images_count; $j++) {
                        $image->update([
                            'product_id' => $id,
                            'image' => $imageUrl[$i],
                            'is_cover' => 0
                        ]);
                }
//        }
    }
        return $imageUrl;
    }
}
