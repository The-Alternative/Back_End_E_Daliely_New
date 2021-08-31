<?php

namespace App\Service\Offer;

use App\Http\Requests\Offer\OfferUserRequest;
use App\Models\Offer\OfferUser;
use App\Traits\GeneralTrait;

class OfferUserService
{
    use GeneralTrait;
    protected $OfferUserModel;

    public function __construct(OfferUser $interaction)
    {
        $this->OfferUserModel=$interaction;
    }

    public function get()
    {
        try{
            $interaction=$this->OfferUserModel::paginate(5);
            return $this->returnData('Interaction',$interaction,'Done');
        }
        catch (\Exception $ex)
        {
            return $this->returnError($ex->getCode(),$ex->getMessage());
        }
    }

    public function getById($id)
    {
        try{
            $interaction=$this->OfferUserModel::find($id);
            if(!$interaction)
            {
                return $this->returnError('400','not found this interaction');
            }
            else
            {
                return $this->returnData('interaction',$interaction,'Done');
            }
        }
        catch (\Exception $ex)
        {
            return  $this->returnError($ex->getCode(),$ex->getMessage());
        }
    }

    public function create(OfferUserRequest $request)
    {
        try {
            $interaction=new $this->OfferUserModel;

            $interaction->user_id = $request->user_id;
            $interaction->offer_id =$request->offer_id;
            $interaction->interaction_type =$request->interaction_type;
            $interaction->is_active =$request->is_active;

            $result=   $interaction->save();
            if(!$result){
                return $this->returnError('400','saving failed');
            }
            else {
               return $this->returnData('interaction',$interaction,'done');
            }

        }
        catch(\Exception $ex)
        {
            return  $this->returnError($ex->getCode(),$ex->getMessage());
        }
    }

    public function update(OfferUserRequest $request,$id)
    {
        Try
        {
            $interaction=$this->OfferUserModel::find($id);
            $interaction->user_id = $request->user_id;
            $interaction->offer_id =$request->offer_id;
            $interaction->interaction_type =$request->interaction_type;
            $interaction->is_active =$request->is_active;


            $result=   $interaction->save();
            if(!$result){
                return $this->returnError('400','saving failed');
            }
            else {
                return $this->returnData('interaction',$interaction,'done');
            }

        }
        catch (\Exception $ex)
        {
            return $this->returnError($ex->getCode(),$ex->getMessage());
        }

    }

    public function Trash($id)
    {
        try{
            $interaction=$this->OfferUserModel::find($id);
            if(!$interaction)
            {
                return  $this->returnError('400','not found this interaction');
            }
            else
            {
                $interaction->is_active=0;
                $interaction->save();
                return $this->returnData('interaction',$interaction,'this interaction is trashed now');
            }
        }
        catch (\Exception $ex)
        {
            return $this->returnError($ex->getCode(),$ex->getMessage());
        }
    }
    public function getTrashed()
    {
        try{
            $interaction=$this->OfferUserModel::NotActive();
            return $this->returnData('interaction',$interaction,'done');
        }
        catch (\Exception $ex)
        {
            return $this->returnError($ex->getCode(),$ex->getMessage());
        }
    }
    public function restoreTrashed($id)
    {
        try{
            $interaction=$this->OfferUserModel::find($id);
            if(!$interaction)
            {
                return $this->returnError('400','not found this interaction');
            }
            else
            {
                $interaction->is_active=1;
                $interaction->save();

                return $this->returnData('interaction',$interaction,'this interaction is restore trashed now');
            }
        }
        catch (\Exception $ex)
        {
            return $this->returnError($ex->getCode(),$ex->getMessage());
        }
    }
    public function delete($id)
    {
        try {
            $interaction = $this->OfferUserModel::find($id);
            if (!$interaction) {
                return $this->returnError('400', 'not found this interaction');
            } elseif ($interaction->is_active == 0) {
                $interaction->delete();
                return $this->returnData('interaction', $interaction, 'this interaction is deleted now');
            } else {
                return $this->returnData('400', $interaction,'this interaction can not deleted now');
            }
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
