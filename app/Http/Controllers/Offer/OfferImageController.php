<?php

namespace App\Http\Controllers\Offer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Offer\OfferImage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;



class OfferImageController extends Controller
{
    use GeneralTrait;

    protected $OfferImageModel;

    public function __construct(OfferImage $offerImage)
    {
        $this->OfferImageModel=$offerImage;
    
    }
    public function UploadImage(Request $request)
    {
        
        try{
                if ($request->file('image')){
                        $image=$request->image->getClientOriginalName();
                        $image=time().$image;
                        $request->image->move('images/offers',$image);
        
                    }
                  
             $offerImage=$this->OfferImageModel::create([
                  'offer_id'=>$request->offer_id,
                  'image'=>$image,
                  'is_cover'=>1,  
                  'is_check'=>$request->is_check
              ]);
          
               return $this->returnData('Image',$offerImage,'The image has been saved successfully');
   
           }
    catch(\Exception $ex)
    {
        return $this->returnError($ex->getcode(),$ex->getmessage());

    }

    }

    public function UploadMultiImage(Request $request,$id)
        {
            try{
         
                $validator = Validator::make($request->all(),
                     ['offer_id'=>'required',
                      'images' => 'array',
                      'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
                     ]);

                    $images=$request->file(['images']);
                    //  $path='images/offers';
                     $files          =       array();
               return($images);
                if($request->hasfile('images')){
                    foreach($request->file('images') as $image)
                    {
                        $name =time().'.'.$image->getClientOriginalName();
        
                        if($image->move(public_path('offers'), $name)) {
    
                            $files[]=$name;

                        $upload_status=$this->OfferImageModel::create([
                                               'offer_id'=>$request->offer_id,
                                                'image'=>$files,
                            ]);
                            return $this->returnData('Images', $upload_status,'The image has been saved successfully');
        
                        }
                    }
                }
                    // foreach ($images as $image) {
                    //      $name= $image->getClientOriginalName();
                    //      $image=time().$name;
                    //      $image->move($path,$name);
                    //      $data[]= $name;
                    // }
                  

                //   $offerImage=$this->OfferImageModel::create([
                //         'offer_id'=>$request->offer_id,
                //         'image'=>$data['image_'],
                //     //     // 'is_cover'=>$request->is_cover,  
                //     //     // 'is_check'=>$request->is_check
                //     ]);
                    //  return $this->returnData('Image',$offerImage,'The image has been saved successfully');
                    // return response()->json(['message'=>'success']);

                }
               

               // return $request;
            // }
            catch(\Exception $ex)
            {

                return $this->returnError($ex->getcode(),$ex->getmessage());
            }
        }

  public function deleteImage($id)
        {
            try
            {
               $image=OfferImage::find($id);
               if(!$image)
               return $this->returnError('400','Not Found This Image');
               else{
                   $image->destroy($id);
               return $this->returnData('Image',$image,'The image has been deleted successfully');
            }
        }
            catch(\Exception $ex)
            {
                return $this->returnError($ex->getcode(),$ex->getmessage());
            }
        }

        public function changeIsCover($image_id)
        {
            try{
                $offerimage=OfferImage::find($image_id);
                if(!$offerimage)
                {
                  return  $this->returnError('400','not found this Image');
                }
                else
                {
                    $offerimage->is_cover=0;
                    $offerimage->save();
                return $this->returnData('Image',$offerimage,'this Image is cover = 0 now');
                }
            }
            catch (\Exception $ex)
            {
                return $this->returnError($ex->getCode(),$ex->getMessage());
            }
        }
   
}
