<?php

namespace App\Http\Controllers\DoctorRate;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRate\DoctorRateRequest;
use App\Service\DoctorRate\DoctorRateService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DoctorRateController extends Controller
{
    use GeneralTrait;
    private $DoctorRateService;
    private $response;

    public function __construct(DoctorRateService $DoctorRateService,Response $response )
    {
        $this->DoctorRateService=$DoctorRateService;
        $this->response=$response;
    }

    public function getDoctorRate()
    {
        $response=$this->DoctorRateService->getDoctorRate();
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');

    }

    public function get()
    {

        $response=$this->DoctorRateService->get();
        return $response;
    }

    public function  getById($id)
    {

        $response=$this->DoctorRateService->getById($id);
        return $response;
    }

//    public function getTrashed()
//    {
//        $response= $this->DoctorRateService->getTrashed();
//        return $response;
//
//    }

    public function create(DoctorRateRequest $request)
    {
        $response=$this->DoctorRateService->create($request);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

    public function update(DoctorRateRequest $request,$id)
    {
        $response=$this->DoctorRateService->update($request,$id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');

    }


//    public function trash($id)
//    {
//        $response= $this->DoctorRateService->trash($id);
//        return response($response, 200)
//            ->header('Access-Control-Allow-Origin', '*')
//            ->header('Access-Control-Allow-Methods', '*');
//    }

//    public function restoreTrashed($id)
//    {
//        $response= $this->DoctorRateService->restoreTrashed($id);
//        return response($response, 200)
//            ->header('Access-Control-Allow-Origin', '*')
//            ->header('Access-Control-Allow-Methods', '*');
//    }
////
//    public function delete($id)
//    {
//        $response=$this->DoctorRateService->delete($id);
//        return  response($response,200)
//            ->header('Access-control-Allow-Origin','*')
//            ->header('Access-control-Allow-Methods','*');
//    }


}
