<?php

namespace App\Service\Mail;

use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Mail;


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
