<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\Image;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('image');
        $folder = public_path('images/products' . '/' . 19 . '/');
        $filename = time() . '.' . $image->getClientOriginalName() . '.' . $image->getClientOriginalExtension();
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0775, true, true);
//             $location = storage_path('/app/public/images'  . '/' . 5 . '/' . $filename);
//            Image::make($image)->resize(800,400)->save($location); //resizing and saving the image

        }
    $file_extension= $request-> image-> getClientOriginalExtension();
//   $file_name = time().$file_extension;
   $path='images/brands';
        $request->image->move($folder,$filename);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\c $c
     * @return \Illuminate\Http\Response
     */
    public function show(c $c)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\c $c
     * @return \Illuminate\Http\Response
     */
    public function edit(c $c)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\c $c
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\c $c
     * @return \Illuminate\Http\Response
     */
    public function destroy(c $c)
    {
        //
    }

    public function uploadImage($image, $folder)
    {
        $image->store('/', $folder);
        $filename = $image->hashName();
        $path = 'images/' . $folder . '/' . $filename;
        return $path;
    }



//        $insert=Test::create([
//            'image' => $request['image']
//            ]
//    );
//    }
}
