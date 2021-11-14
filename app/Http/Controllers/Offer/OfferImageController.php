<?php

namespace App\Http\Controllers\Offer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Offer\OfferImage;
use App\Models\Offer\Offer;
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
                  'is_cover'=>0,  
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
                $data = array();
             
                if(!$request->hasfile('images'))
                {    return response()->json(['not found the files'], 400);
                }

                $files=$request->file(['images']);
                    $folder = public_path('images/offers' . '/' . $id . '/');
                    if (!File::exists($folder)) {
                        File::makeDirectory($folder, 0775, true, true);
                    }
                 
                    foreach($files as $image)
                    {
                        $name[]=time().$image->getClientOriginalName();
                        $image->move($folder, time().$image->getClientOriginalName());
                    }
                    foreach ($name as $f) {
                        $imageUrl[]='images/offers/' . $id  . '/' .  $f;
                    }
                   
                   foreach($imageUrl as $D){
                       $offerImage= new OfferImage();
               
                         $offerImage->offer_id = $id;
                         $offerImage->is_cover=0;
                         $offerImage->image=$D;
                         $offerImage->save();
                  }  
                  return $imageUrl;
               
                    }
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
               if($image){
                   $image_old=$image->image;
                  $old = public_path($image_old);

                if (File::exists($old)) {
                   unlink($old);     
                }   
                   $image->destroy($id);
                   return  $this->returnSuccessMessage('image', 'delete success');
            }
        
               else{
                return  $this->returnSuccessMessage('image', ' Not deleted');
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
                    $offerimage->is_cover=1;
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
