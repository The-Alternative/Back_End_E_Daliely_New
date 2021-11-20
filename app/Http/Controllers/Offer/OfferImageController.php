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

  

    public function UploadMultiImage(Request $request,$offer_id)
        {
            
            try{           
                $offerid=OfferImage::where('offer_id',$offer_id)->get();    
              
                if(!$request->hasfile('images'))
                {    
                    return response()->json(['not found the files'], 400);
                }

                    $files=$request->file(['images']);
                    $folder = public_path('images/offers' . '/' . $offer_id . '/');
                    if (!File::exists($folder)) {
                        File::makeDirectory($folder, 0775, true, true);
                    }
                 
                    foreach($files as $image)
                    {
                        $name[]=time().$image->getClientOriginalName();
                        $image->move($folder, time().$image->getClientOriginalName());
                    
                    }
                   
                    foreach ($name as $f) {
                        $imageUrl[]='images/offers/' . $offer_id  . '/' .  $f;
                    }
                  
               
                      $offer= count($offerid);

                    if($offer == 0){
                          
                    foreach($imageUrl as $index=>$D){

                         $offerImage= new OfferImage();
                         $offerImage->offer_id = $offer_id;
                         $offerImage->image=$D;
                         $offerImage->is_cover=  $index== 0 ?1:0 ;
                         $offerImage->save();  
                    }
                }else{
                  
                    foreach($imageUrl as  $index=>$s){

                        $offerImage= new OfferImage();
                        $offerImage->offer_id = $offer_id;
                        $offerImage->image=$s;
                        $offerImage->is_cover=0 ;
                        $offerImage->save();  
                          
                }
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

        public function changeIsCover($offer_id,$image_id)
        {
            try{
                $offerimages=OfferImage::where('offer_id',$offer_id)->get();
                if(count($offerimages)==0)
                {
                  return  $this->returnError('400','not found this Image');
                }
                foreach($offerimages as $image){
                    
                    $image->update([
                        'is_cover'=>0,
                    ]);
                }
                
                $Offerimagecover=OfferImage::where('offer_id',$offer_id)->find($image_id);
                   
                    $Offerimagecover->Update([
                   'is_cover'=>1 ,
                ]);

                return $this->returnSuccessMessage('Images', 'update the image successfully' );
                
            }
            catch (\Exception $ex)
            {
                return $this->returnError($ex->getCode(),$ex->getMessage());
            }
        }
   
       
}
