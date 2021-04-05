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
    private $response;

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

    public function getTrashed()
    {
        return  $this->AppointmentService->getTrashed();
    }

    public function create(AppointmentRequest $request)
    {
        $response=$this->AppointmentService->create($request);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

    public function update(AppointmentRequest $request,$id)
    {
        $response=$this->AppointmentService->update($request,$id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');

    }
//    public function search($name)
//    {
//        $response= $this->AppointmentService->search($name);
//        return response($response, 200)
//            ->header('Access-Control-Allow-Origin', '*')
//            ->header('Access-Control-Allow-Methods', '*');
//    }

    public function trash($id)
    {
        $response= $this->AppointmentService->trash($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function restoreTrashed($id)
    {
        $response= $this->AppointmentService->restoreTrashed($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function delete($id)
    {
        $response=$this->AppointmentService->delete($id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }
}
