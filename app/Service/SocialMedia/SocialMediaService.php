<?php


namespace App\Service\SocialMedia;


use App\Http\Requests\SocialMedia\SocialMediaRequest;
use App\Models\SocialMedia\SocialMedia;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class SocialMediaService
{
    private $SocialMediaModel;
    use GeneralTrait;

    public function __construct(SocialMedia $SocialMedia)
    {
        $this->SocialMediaModel=$SocialMedia;
    }
    public function get()
    {
        try{
        $SocialMedia=$this->SocialMediaModel::IsActive()->all();
        return $this->returnData('SocialMedia',$SocialMedia,'done');
        }
        catch (\Exception $ex) {
            return $this->returnError('400', 'failed');
        }
    }
    public function getById($id)
    {
        try{
        $SocialMedia= $this->SocialMediaModel::find($id);
            if (is_null($SocialMedia)){
                return $this->returnSuccessMessage('this Social Media not found','done');
            }
            else{
                return $this->returnData('Social Media',$SocialMedia,'done');
            }
        }
        catch (\Exception $ex) {
            return $this->returnError('400', 'failed');
        }
    }

    public function create( SocialMediaRequest $request )
    {
        try{
                   $SocialMedia=new SocialMedia();

                   $SocialMedia->phone_number                       =$request->phone_number ;
                   $SocialMedia->whatsapp_number                    =$request->whatsapp_number;
                   $SocialMedia->facebook_account                   =$request->facebook_account;
                   $SocialMedia->instagram_account                  =$request->instagram_account;
                   $SocialMedia->telegram_number                    =$request->telegram_number ;
                   $SocialMedia->email                              =$request->email  ;
                   $SocialMedia->doctor_id                          =$request->doctor_id   ;
                   $SocialMedia->is_active                          =$request->is_active   ;

                   $result=$SocialMedia->save();
                   if ($result)
                   {
                       return $this->returnData('SocialMedia', $SocialMedia,'done');
                   }
                   else
                   {
                       return $this->returnError('400', 'saving failed');
                   }
        }
        catch (\Exception $ex) {
            return $this->returnError('400', 'failed');
        }
   }
    public function update(SocialMediaRequest $request,$id)
    {
        try{
        $SocialMedia= $this->SocialMediaModel::find($id);

        $SocialMedia->phone_number                       =$request->phone_number ;
        $SocialMedia->whatsapp_number                    =$request->whatsapp_number;
        $SocialMedia->facebook_account                   =$request->facebook_account;
        $SocialMedia->instagram_account                  =$request->instagram_account;
        $SocialMedia->telegram_number                    =$request->telegram_number ;
        $SocialMedia->email                              =$request->email  ;
        $SocialMedia->doctor_id                          =$request->doctor_id   ;
        $SocialMedia->is_active                          =$request->is_active   ;

        $result=$SocialMedia->save();
        if ($result)
        {
            return $this->returnData('SocialMedia', $SocialMedia,'done');
        }
        else
        {
            return $this->returnError('400', 'updating failed');
        }
        }
        catch (\Exception $ex) {
            return $this->returnError('400', 'failed');
        }

    }
    public function trash( $id)
    {
        try{
        $SocialMedia= $this->SocialMediaModel::find($id);
            if (is_null($SocialMedia)) {
                return $this->returnSuccessMessage('This Medical file not found', 'done');
            }
            else
            {
                $SocialMedia->is_active=false;
                $SocialMedia->save();
                return $this->returnData('SocialMedia', $SocialMedia,'This SocialMedia is trashed Now');
            }
        }
        catch (\Exception $ex) {
            return $this->returnError('400', 'failed');
        }
    }
    public function getTrashed()
    {
        try{
        $SocialMedia= $this->SocialMediaModel::NotActive();
        return $this -> returnData('SocialMedia',$SocialMedia,'done');
        }
        catch (\Exception $ex) {
            return $this->returnError('400', 'failed');
        }
    }
    public function restoreTrashed( $id)
    {
        try{
        $SocialMedia=SocialMedia::find($id);
        if (is_null($SocialMedia)) {
            return $this->returnSuccessMessage('This Social Media not found', 'done');
        }
        else
        {
            $SocialMedia->is_active=true;
            $SocialMedia->save();
            return $this->returnData('SocialMedia', $SocialMedia,'This SocialMedia is trashed Now');
        }
    }
        catch (\Exception $ex) {
              return $this->returnError('400', 'failed');
       }

    }
    public function delete($id)
    {
        try{
        $SocialMedia = SocialMedia::find($id);
            if ($SocialMedia->is_active == 0) {
                $SocialMedia = $this->SocialMediaModel->destroy($id);
            }
        return $this->returnData('SocialMedia', $SocialMedia, 'This SocialMedia is deleted Now');
        }
        catch (\Exception $ex) {
            return $this->returnError('400', 'failed');
        }
    }

}
