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

    public function create(ClinicRequest $request)
    {
        return $this->ClinicService->create($request);
    }

    public function update(ClinicRequest $request,$id)
    {
        return  $response=$this->ClinicService->update($request,$id);
    }
    public function search($name)
    {
        return $response= $this->ClinicService->search($name);
    }

    public function trash($id)
    {
        return  $response= $this->ClinicService->trash($id);
    }
    public function getTrashed()
    {
        return  $this->ClinicService->getTrashed();
    }

    public function restoreTrashed($id)
    {
        return $response= $this->ClinicService->restoreTrashed($id);
    }

    public function delete($id)
    {
        return $response=$this->ClinicService->delete($id);
    }
}
