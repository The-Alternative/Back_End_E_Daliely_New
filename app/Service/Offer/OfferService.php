<?php

namespace App\Service\Offer;

use App\Http\Requests\Offer\OfferRequest;
use App\Models\Offer\Offer;
use App\Models\Offer\OfferImage;
use App\Models\Offer\OfferTranslation;
use App\Models\Stores\Store;
use App\Models\User;
use App\Notifications\Notifications;
use App\Traits\GeneralTrait;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OfferMail;
use Tymon\JWTAuth\Contracts\JWTSubject;
//use Notification;
use App\Service\Mail\MailService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Offer\OfferImageController;
use Illuminate\Http\Request;



class OfferService
{

    use GeneralTrait;
    protected $OfferModel;
    protected $OfferImageModel;
    protected $StoreModel;
    protected $MailService;

    public function __construct(Offer $offer,Store $store,MailService $MailService,OfferImage $offerImage)
    {
        $this->OfferModel=$offer;
        $this->StoreModel=$store;
        $this->MailService=$MailService;
        $this->OfferImageModel=$offerImage;

    }

    //get all offer
    public function get()
    {
        try{
            $offer=$this->OfferModel::with('OfferImage')->paginate(5);
            return $this->returnData('Offer',$offer,'Done');
        }
        catch (\Exception $ex)
        {
            return $this->returnError($ex->getCode(),$ex->getMessage());
        }
    }
//get offer by offer's id
    public function getById($id)
    {
        try{
            $offer=Offer::with('OfferImage')->find($id);
            if(!$offer)
            {
                return $this->returnError('400','not found this offer');
            }
            else
            {
               return $this->returnData('offer',$offer,'Done');
            }
        }
        catch (\Exception $ex)
        {
         return  $this->returnError($ex->getCode(),$ex->getMessage());
        }
    }

    //create new offer
    public function create(OfferRequest $request)
    {
    
        try {
             $offer=collect($request->Offer)->all();
            DB::beginTransaction();
            $untransId=$this->OfferModel::insertGetId([
                'store_id'        =>$request->store_id,
                'store_product_id'=>$request->store_product_id,
                'user_email'      =>$request->user_email,
                'price'           =>$request->price,
                'selling_price'   =>$request->selling_price,
                'quantity'        =>$request->quantity,
                'position'        =>$request->position,
                'started_at'      =>$request->started_at,
                'ended_at'        =>$request->ended_at,
                'is_active'       =>$request->is_active,
                'is_offer'        =>$request->is_offer,
                'is_approved'     =>$request->is_approved

            ]);
             if(isset($offer)) {
                 foreach ($offer as $offers) {
                     $transOffer[] = [
                         'name' => $offers ['name'],
                         'short_description' => $offers['short_description'],
                         'long_description' => $offers['long_description'],
                         'locale' => $offers['locale'],
                         'offer_id' => $untransId,
                     ];
                 }
                 OfferTranslation::insert($transOffer);
             }
              DB::commit();

              $images = $request->images;
              if ($request->hasfile('images')) {
                  $folder = public_path('images/offers' . '/' . $untransId . '/');
                  foreach ($images as $image) {
                      $offer = $this->OfferModel->find($untransId);
                      $offer->OfferImage()->insert([
                          'offer_id' => $untransId,
                          'image' => $this->upload( $image['image'],$untransId,$folder),
                          'is_cover' => 0,
                      ]);
                  }
                  }
                    //Send Mail
               $this->MailService->SendMail($untransId,Offer::class, $request->user_email);
               
               //Send Notification
               $notification=Offer::find($untransId);
               Notification::send($notification,new Notifications($notification));
            
               return $this->returnData('offer', [$untransId,$transOffer], 'Mail Send Successfully');
  
        }
    
        catch(\Exception $ex)
        {
            DB::rollBack();
           return  $this->returnError($ex->getCode(),$ex->getMessage());
        }
    }

    
//update old offer
    public function update(OfferRequest $request,$id)
    {
      Try
      {
          $offer=$this->OfferModel::find($id);
          if(!$offer)
          {return $this->returnError('400','not found this offer');}
          $alloffer=collect($request->Offer)->all();
          if(!($request->has('offers.is_active')))
          $request->request->add(['is_active'=>0]);
          else{$request->request->add(['is_active',1]);}

          $newoffer=$this->OfferModel::where('offers.id',$id)->update([
              'store_id'        =>$request->store_id,
              'store_product_id'=>$request->store_product_id,
              'user_email'      =>$request->user_email,
              'price'           =>$request->price,
              'selling_price'   =>$request->selling_price,
              'quantity'        =>$request->quantity,
              'position'        =>$request->position,
              'started_at'      =>$request->started_at,
              'ended_at'        =>$request->ended_at,
              'is_active'       =>$request->is_active,
              'is_offer'        =>$request->is_offer,
              'is_approved'        =>$request->is_approved

          ]);
          $db_offer=array_values(OfferTranslation::where('offer_translations.offer_id',$id)
              ->get()->all());

          $dboffer=(array_values($db_offer));
          $request_offer=(array_values($request->Offer));
          foreach ($dboffer as $dboffers){
              foreach ($request_offer as $request_offers){
                  $value=OfferTranslation::where('offer_translations.offer_id',$id)
                      ->where('locale',$request_offers['locale'])
                      ->update([
                          'name'=>$request_offers['name'],
                          'short_description'=>$request_offers['short_description'],
                          'long_description'=>$request_offers['long_description'],
                          'offer_id'=>$id
                      ]);
              }
          }
          DB::commit();
          return $this->returnData('offer',[$dboffer,$value],'done');
      }
      catch (\Exception $ex)
      {
          return $this->returnError($ex->getCode(),$ex->getMessage());
      }

    }
// change is_active value to zero
    public function Trash($id)
    {
        try{
            $offer=$this->OfferModel::find($id);
            if(!$offer)
            {
              return  $this->returnError('400','not found this offer');
            }
            else
            {
                $offer->is_active=0;
                $offer->save();
            return $this->returnData('offer',$offer,'this offer is trashed now');
            }
        }
        catch (\Exception $ex)
        {
            return $this->returnError($ex->getCode(),$ex->getMessage());
        }
    }
//change is_active value to one
    public function restoreTrashed($id)
    {
        try{
            $offer=$this->OfferModel::find($id);
            if(!$offer)
            {
                return $this->returnError('400','not found this offer');
            }
            else
            {
                $offer->is_active=1;
                $offer->save();

                return $this->returnData('offer',$offer,'this offer is restore trashed now');
            }
        }
        catch (\Exception $ex)
        {
            return $this->returnError($ex->getCode(),$ex->getMessage());
        }
    }
    //delete the offer from database
    public function delete($id)
    {
        try
        {
            $offer=$this->OfferModel::find($id);
            if(!$offer)
            {
                return $this->returnError('400','not found this offer');
            }
            elseif($offer->is_active == "Not Active"){
                $offer->delete();
                $offer->OfferTranslation()->delete();

                return $this->returnData('offer',$offer,'this offer is deleted now');
            }

            else{
                return $this->returnError('400','this offer can not deleted now');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError($ex->getCode(),$ex->getMessage());
        }
    }
    //Find out the store that offers this offer through this offer ID
    public function getStoreByOfferId($Offer_id)
    {
        try{
            $offer=$this->OfferModel::find($Offer_id);
            if (!$offer)
            {
                return $this->returnError('400','not found this Offer');
            }
            else {
                $offer=$this->OfferModel::with('Store')->find($Offer_id);
                return $this->returnData('Offer', $offer, 'done');
            }
        }
        catch (\Exception $ex)
        {
            return $this->returnError($ex->getCode(),$ex->getMessage());
        }
    }
//Find out about store offers via store ID
    public function getOfferByStoreId($Store_id)
    {
        try{
            $store=$this->StoreModel::find($Store_id);
            if(!$store)
            {return $this->returnError('400','not found this store');
            }
            else {
                $store=$this->StoreModel::with('Offer')->find($Store_id);
                return  $this->returnData('Store',$store,'done');
            }
        }
        catch (\Exception $ex)
        {
            return $this->returnError($ex->getCode(),$ex->getMessage());
        }
    }
//_____________________________________________________________________________//
//get offer where is_Active=0
    public function getTrashed()
    {
        try{
            $offer=$this->OfferModel::NotActive();
            return $this->returnData('offer',$offer,'done');
        }
        catch (\Exception $ex)
        {
            return $this->returnError($ex->getCode(),$ex->getMessage());
        }
    }
//get the advertisement
    public function getAdvertisement()
    {
        try{
            $offer=$this->OfferModel::Advertisement();
            return $this->returnData('advertisement',$offer,'this is advertisements');
        }
        catch(\Exception $ex)
        {
            return $this->returnError($ex->getCode(),$ex->getMessage());
        }
    }
        public function OfferApproved($offer_id)
        {
           
            try{
                $offer=$this->OfferModel::find($offer_id);
                if(!$offer)
                return $this->returnError('400','not found this offer');
                else {
                    $offer->is_approved=1;
                    $offer->save();
                return $this->returnData('offer',$offer,'offer is approved');
                }
            }
            catch(\Exception $ex)
            {
                return $this->returnError($ex->getcode(),$ex->getmessage());
            }
        }
    }