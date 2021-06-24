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

    public function __construct(DoctorRateService $DoctorRateService,Response $response )
    {
        $this->DoctorRateService=$DoctorRateService;
        $this->response=$response;
    }

    public function get()
    {
        return $this->DoctorRateService->get();
    }

    public function  getById($id)
    {
        return  $this->DoctorRateService->getById($id);
    }

    public function getTrashed()
    {
        return  $this->DoctorRateService->getTrashed();
    }

    public function create(DoctorRateRequest $request)
    {
        return  $this->DoctorRateService->create($request);
    }

    public function update(DoctorRateRequest $request,$id)
    {
        return $this->DoctorRateService->update($request,$id);
    }

    public function trash($id)
    {
        return $this->DoctorRateService->trash($id);
    }

    public function restoreTrashed($id)
    {
        return $this->DoctorRateService->restoreTrashed($id);
    }

    public function delete($id)
    {
        return $this->DoctorRateService->delete($id);
    }
}
