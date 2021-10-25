<?php

namespace App\Service\Notification;

use App\Models\Notification\Notification;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class NotificationService
{

    use GeneralTrait;

    private $NotificationModel;
  

    public function __construct(Notification $notification)
    {
        $this->NotificationModel=$notification;
    }

    //get all notification
    public function get()
    {
        try{
            $notification=$this->NotificationModel::get();
            return $this->returnData('Notification',$notification,'Done');
        }
        catch (\Exception $ex)
        {
            return $this->returnError($ex->getCode(),$ex->getMessage());
        }
    }

    public function updateRead_at()
    {
        try{
            $notification=$this->NotificationModel::get();
            return $this->returnData('Notification',$notification,'Done');
        }
        catch (\Exception $ex)
        {
            return $this->returnError($ex->getCode(),$ex->getMessage());
        }

    }
}