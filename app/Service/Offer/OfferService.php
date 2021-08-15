<?php

namespace App\Service\Offer;

use App\Http\Requests\Offer\OfferRequest;
use App\Models\Offer\Offer;
use App\Models\Offer\OfferTranslation;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class OfferService
{

    use GeneralTrait;
    protected $OfferModel;

    public function __construct(Offer $offer)
    {
        $this->OfferModel=$offer;
    }

    public function get()
    {
        try{
            $offer=$this->OfferModel::paginate(5);
            return $this->returnData('Offer',$offer,'Done');
        }
        catch (\Exception $ex)
        {
            return $this->returnError($ex->getCode(),$ex->getMessage());
        }
    }

    public function getById($id)
    {
        try{
            $offer=$this->OfferModel::find($id);
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

    public function create(OfferRequest $request)
    {
        try {
            $offer=collect($request->Offer)->all();
            DB::beginTransaction();
            $untransId=$this->OfferModel::insertGetId([
                'store_id'        =>$request->store_id,
                'store_product_id'=>$request->store_product_id,
                'image'           =>$request->image,
                'price'           =>$request->price,
                'selling_price'   =>$request->selling_price,
                'quantity'        =>$request->quantity,
                'position'        =>$request->position,
                'started_at'      =>$request->started_at,
                'ended_at'        =>$request->ended_at,
                'is_active'       =>$request->is_active,
                'is_offer'        =>$request->is_offer
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
              return $this->returnData('offer', $offer, 'done');
        }
        catch(\Exception $ex)
        {
            DB::rollBack();
           return  $this->returnError($ex->getCode(),$ex->getMessage());
        }
    }

    public function update(OfferRequest $request,$id)
    {
        return "hello";
    }

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
    public function NotActive()
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
    public function delete($id)
    {
        try
        {
            $offer=$this->OfferModel::find($id);
            if(!$offer)
            {
                return $this->returnError('400','not found this offer');
            }
            elseif($offer->is_active==0){
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
}
