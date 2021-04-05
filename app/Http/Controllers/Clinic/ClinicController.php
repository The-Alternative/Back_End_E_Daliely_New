<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clinic\ClinicRequest;
use App\Service\Clinic\ClinicService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClinicController extends Controller
{
    use GeneralTrait;
    private $ClinicService;
    private $response;

    public function __construct(ClinicService $ClinicService,Response $response )
    {
        $this->ClinicService=$ClinicService;
        $this->response=$response;
    }

    public function get()
    {
        return $this->ClinicService->get();
    }

    public function  getById($id)
    {
        return $this->ClinicService->getById($id);
    }

    public function getTrashed()
    {
        return  $this->ClinicService->getTrashed();
    }

    public function create(ClinicRequest $request)
    {
        $response=$this->ClinicService->create($request);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

    public function update(ClinicRequest $request,$id)
    {
        $response=$this->ClinicService->update($request,$id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');

    }
    public function search($name)
    {
        $response= $this->ClinicService->search($name);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function trash($id)
    {
        $response= $this->ClinicService->trash($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function restoreTrashed($id)
    {
        $response= $this->ClinicService->restoreTrashed($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function delete($id)
    {
        $response=$this->ClinicService->delete($id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }
}
