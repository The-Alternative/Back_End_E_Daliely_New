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
        $SocialMedia=$this->SocialMediaModel::IsActive()->all();
        return $this->returnData('SocialMedia',$SocialMedia,'done');
    }
    public function getById($id)
    {
        $SocialMedia= $this->SocialMediaModel::find($id);
        return $this->returnData('SocialMedia',$SocialMedia,'done');
    }
    public function getTrashed()
    {
        $SocialMedia= $this->SocialMediaModel::NotActive();
        return $this -> returnData('SocialMedia',$SocialMedia,'done');
    }
    public function create( SocialMediaRequest $request )
    {
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
    public function update(SocialMediaRequest $request,$id)
    {
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
    public function trash( $id)
    {
        $SocialMedia= $this->SocialMediaModel::find($id);
        $SocialMedia->is_active=false;
        $SocialMedia->save();

        return $this->returnData('SocialMedia', $SocialMedia,'This SocialMedia is trashed Now');
    }
    public function restoreTrashed( $id)
    {
        $SocialMedia=SocialMedia::find($id);
        $SocialMedia->is_active=true;
        $SocialMedia->save();

        return $this->returnData('SocialMedia', $SocialMedia,'This SocialMedia is trashed Now');
    }
    public function delete($id)
    {
        $SocialMedia = SocialMedia::find($id);
        $SocialMedia->is_active = false;
        $SocialMedia->save();
        return $this->returnData('SocialMedia', $SocialMedia, 'This SocialMedia is deleted Now');
    }

}
