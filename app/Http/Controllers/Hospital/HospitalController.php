<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hospital\HospitalRequest;
use App\Service\Hospital\HospitalService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HospitalController extends Controller
{
    use GeneralTrait;
    private $HospitalService;
    private $response;

    public function __construct(HospitalService $HospitalService,Response $response )
    {
        $this->HospitalService=$HospitalService;
        $this->response=$response;
    }
    public function get()
    {
        return $this->HospitalService->get();
    }

    public function  getById($id)
    {
        return $this->HospitalService->getById($id);
    }

    public function getTrashed()
    {
        return$this->HospitalService->getTrashed();
    }

    public function create(HospitalRequest $request)
    {
        $response=$this->HospitalService->create($request);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

    public function update(HospitalRequest $request,$id)
    {
        $response=$this->HospitalService->update($request,$id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');

    }
    public function search($name)
    {
        $response= $this->HospitalService->search($name);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function trash($id)
    {
        $response= $this->HospitalService->trash($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function restoreTrashed($id)
    {
        $response= $this->HospitalService->restoreTrashed($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
//
    public function delete($id)
    {
        $response=$this->HospitalService->delete($id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

    //get all the doctors who work in the hospital according to her name

    public function hospitalsDoctor($hospital_name)
    {
        $response=$this->HospitalService->hospitalsDoctor($hospital_name);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');


    }

}
