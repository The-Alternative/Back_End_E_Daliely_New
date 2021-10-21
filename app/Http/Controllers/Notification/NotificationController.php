<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Notification\NotificationService;
use App\Traits\GeneralTrait;

class NotificationController extends Controller
{
    use GeneralTrait;
     private $NotificationService;

    public function __construct (NotificationService $notificationService)
    {
       $this->NotificationService=$notificationService;
    }

    public function get()
    {
        return $this->NotificationService->get();
    }
}
