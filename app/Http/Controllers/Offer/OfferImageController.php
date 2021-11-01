<?php

namespace App\Http\Controllers\Offer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Offer\OfferImage;


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
        //     // return $request;
            if ($request->hasfile('image')){
                            $image=$request->image->getClientOriginalName();
                            $image=time().$image;
                            $request->image->move('images/offers',$image);
            
            
                        // return "success save Image";
        }

            $offerImage=$this->OfferImageModel::create([
                'offer_id'=>$request->offer_id,
                'image'=>$image,
                'is_cover'=>$request->is_cover,  
                'is_check'=>$request->is_check
            ]);
            return $this->returnData('image',$image,'The image has been saved successfully');
        
          return "success save Image";
        }catch(\Exception $ex)
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
   
}
