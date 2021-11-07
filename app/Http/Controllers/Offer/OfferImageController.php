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
             
                if($request->hasfile(['images']))
                {        
                    $folder = public_path('images/offers' . '/' . $id . '/');
                    if (!File::exists($folder)) {
                        File::makeDirectory($folder, 0775, true, true);
                    }
                 
                    foreach($request->file(['images']) as $image)
                    {
                        $name=time().$image->getClientOriginalName();;
                        $image->move($folder, $name);
            
                        //populate array here
                      array_push($data, $name);
                   
                       $offerImage= new OfferImage();
               
                         $offerImage->offer_id = $id;
                         $offerImage->is_cover=0;
                         $offerImage->image=$data;
                         $offerImage->save();
                  }  
                
               }
                return $this->returnData('images',[$data],'image created successfully.');
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
