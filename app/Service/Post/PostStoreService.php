<?php


namespace App\Service\Post;


use App\Http\Requests\PostStore\PostStoreRequest;
use App\Models\Post\PostStore;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;

class PostStoreService
{
    private $PostStoreModel;
    use GeneralTrait;

    public function __construct(PostStore $offers)
    {
        $this->PostStoreModel=$offers;
    }
    public function get()
    {
        try {
            $offers = $this->PostStoreModel::paginate(5);
            return $this->returnData('offers', $offers, 'done');
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    public function getById($id)
    {
        try{
            $offers= $this->PostStoreModel::find($id);
            if (is_null($offers)){
                return $this->returnSuccessMessage('this offers not found','done');
            }
            else{
                return $this->returnData('offers',$offers,'done');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
    //__________________________________________________________//
    public function create( PostStoreRequest $request )
    {
        try {
            $offers = new PostStore();

            $offers->post_id                 = $request->post_id;
            $offers->store_id                = $request->store_id;
            $offers->start_date_time         = $request->start_date_time;
            $offers->end_date_time           = $request->end_date_time;
            $offers->price                   = $request->price;
            $offers->new_price               = $request->new_price;
            $offers->is_approved             = $request->is_approved;
            $offers->is_active               = $request->is_active;

            $result = $offers->save();

            if ($result)
            {
                return $this->returnData('offers', $offers, 'done');
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
    public function update(PostStoreRequest  $request,$id)
    {
        try{
            $offers= $this->PostStoreModel::find($id);

            $offers->post_id                 = $request->post_id;
            $offers->store_id                = $request->store_id;
            $offers->start_date_time         = $request->start_date_time;
            $offers->end_date_time           = $request->end_date_time;
            $offers->price                   = $request->price;
            $offers->new_price               = $request->new_price;
            $offers->is_approved             = $request->is_approved;
            $offers->is_active               = $request->is_active;

            $result = $offers->save();

            if ($result)
            {
                return $this->returnData('offers', $offers, 'done');
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
            $offers= $this->PostStoreModel::find($id);
            if (is_null($offers)) {
                return $this->returnSuccessMessage('This offers not found', 'done');
            }
            else
            {
                $offers->is_active=0;
                $offers->save();
                return $this->returnData('offers', $offers,'This offers is trashed Now');
            }
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }

    }
    public function getTrashed()
    {
        try{
            $offers= $this->PostStoreModel::NotActive();
            return $this -> returnData('offers',$offers,'done');
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }

    public function restoreTrashed( $id)
    {
        try{
            $offers= $this->PostStoreModel::find($id);
            if (is_null($offers)) {
                return $this->returnSuccessMessage('This offers not found', 'done');
            }
            else
            {
                $offers->is_active=1;
                $offers->save();
                return $this->returnData('offers', $offers,'This offers is trashed Now');
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
            $offers= $this->PostStoreModel::find($id);
            if ($offers->is_active == 0) {

                $offers->delete();
                return $this->returnData('offers', $offers, 'This offers is deleted Now');
            }
            else{
                return $this->returnData('offers', $offers, 'This offers can not deleted Now');
            }
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
}
