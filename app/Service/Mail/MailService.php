<?php

namespace App\Service\Mail;

use App\Models\Doctors\Doctor;
use App\Models\Offer\Offer;
use App\Models\Restaurant\Restaurant;
use App\Models\Stores\Store;
use App\Notifications\OfferNotification;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model ;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class MailService
{
    use GeneralTrait;


    public function SendMail($id,$model,$email)
    {
        try {
          $sendmail= $model::find($id)->toArray();
            if (!$sendmail)
                return $this->returnError('400', 'This Model not found');
            else {
                Mail::send('email.sendmail', $sendmail, function ($message) use ($email) {
                    $message->to($email);
                    $message->subject('Welcome Mail');
                });
            }
        }
        catch(\Exception $ex){
            return $this->returnError($ex->getCode(),$ex->getMessage());

        }
    }

}
