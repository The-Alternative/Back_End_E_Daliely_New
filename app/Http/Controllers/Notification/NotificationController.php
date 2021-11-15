<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Notification\Notification;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class NotificationController extends Controller
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

    public function updateRead_at($notification_id)
    {   
        try{
             $notification=Notification::where('notification_id',$notification_id)->update([
                'read_at'=>Carbon::now(),
            ]);
            return $this->returnSuccessMessage('notification','this notification read now');

            }
        catch (\Exception $ex)
        {
            return $this->returnError($ex->getCode(),$ex->getMessage());
        }

    }

}
