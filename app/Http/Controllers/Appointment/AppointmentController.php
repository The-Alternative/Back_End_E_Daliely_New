<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\AppointmentRequest;
use App\Service\Appointment\AppointmentService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AppointmentController extends Controller
{
    use GeneralTrait;
    private $AppointmentService;

    public function __construct(AppointmentService $AppointmentService,Response $response )
    {
        $this->AppointmentService=$AppointmentService;
        $this->response=$response;
    }
    public function get()
    {
        return $this->AppointmentService->get();
    }

    public function  getById($id)
    {
        return $this->AppointmentService->getById($id);
    }

//    public function create(AppointmentRequest $request)
//    {
//        return  $response=$this->AppointmentService->create($request);
//    }
//
//    public function update(AppointmentRequest $request,$id)
//    {
//        return $response=$this->AppointmentService->update($request,$id);
//    }
//
//    public function trash($id)
//    {
//        return   $response= $this->AppointmentService->trash($id);
//    }
//    public function getTrashed()
//    {
//        return  $this->AppointmentService->getTrashed();
//    }
//
//    public function restoreTrashed($id)
//    {
//        return   $response= $this->AppointmentService->restoreTrashed($id);
//    }
//
//    public function delete($id)
//    {
//        return  $response=$this->AppointmentService->delete($id);
//    }
}
