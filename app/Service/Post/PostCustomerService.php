<?php


namespace App\Service\Post;

use App\Http\Requests\PostCustomer\PostCustomerRequest;
use App\Models\Post\PostCustomer;
use App\Traits\GeneralTrait;

class PostCustomerService
{
    private $PostCustomerModel;
    use GeneralTrait;

    public function __construct(PostCustomer $interaction)
    {
        $this->PostCustomerModel=$interaction;
    }
    public function get()
    {
        try {
            $interaction = $this->PostCustomerModel::paginate(5);
            return $this->returnData('interaction', $interaction, 'done');
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    public function getById($id)
    {
        try{
            $interaction= $this->PostCustomerModel::find($id);
            if (is_null($interaction)){
                return $this->returnSuccessMessage('this interaction not found','done');
            }
            else{
                return $this->returnData('interaction',$interaction,'done');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
    //__________________________________________________________//
    public function create( PostCustomerRequest $request )
    {
        try {
            $interaction = new PostCustomer();

            $interaction->post_id      = $request->post_id;
            $interaction->customer_id  = $request->customer_id;
            $interaction->like         = $request->like;
            $interaction->share        = $request->share;
            $interaction->rate         = $request->rate;
            $interaction->is_approved  = $request->is_approved;
            $interaction->is_active    = $request->is_active;

            $result = $interaction->save();

            if ($result)
            {
                return $this->returnData('interaction', $interaction, 'done');
            }
            else
            {
                return $this->returnError('400', 'saving failed');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400', $ex->getMessage());
        }

    }
    //___________________________________________________________________//
    public function update(PostCustomerRequest  $request,$id)
    {
        try{
            $interaction= $this->PostCustomerModel::find($id);

            $interaction->post_id      = $request->post_id;
            $interaction->customer_id  = $request->customer_id;
            $interaction->like         = $request->like;
            $interaction->share        = $request->share;
            $interaction->rate         = $request->rate;
            $interaction->is_approved  = $request->is_approved;
            $interaction->is_active    = $request->is_active;

            $result = $interaction->save();

            if ($result)
            {
                return $this->returnData('interaction', $interaction, 'done');
            }
            else
            {
                return $this->returnError('400', 'saving failed');
            }
            }
        catch(\Exception $ex){
            return $this->returnError('400', $ex->getMessage());
        }
    }
    //____________________________________________________________//
        public function trash( $id)
    {
        try{
            $interaction= $this->PostCustomerModel::find($id);
            if (is_null($interaction)) {
                return $this->returnSuccessMessage('This interaction not found', 'done');
            }
            else
            {
               $interaction->is_active=0;
               $interaction->save();
                return $this->returnData('interaction', $interaction,'This interaction is trashed Now');
            }
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }

    }
    public function getTrashed()
    {
        try{
            $interaction= $this->PostCustomerModel::NotActive();
            return $this -> returnData('interaction',$interaction,'done');
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }

    public function restoreTrashed( $id)
    {
        try{
            $interaction=PostCustomer::find($id);
            if (is_null($interaction)) {
                return $this->returnSuccessMessage('This interaction not found', 'done');
            }
            else
            {
               $interaction->is_active=1;
               $interaction->save();
                return $this->returnData('interaction', $interaction,'This interaction is trashed Now');
            }
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    //________________________________________//
    public function delete($id)
    {
        try{
            $interaction= PostCustomer::find($id);
            if ($interaction->is_active == 0) {

               $interaction->delete();
                return $this->returnData('interaction', $interaction, 'This interaction is deleted Now');
            }
            else{
                return $this->returnData('interaction', $interaction, 'This interaction can not deleted Now');
            }
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
}
