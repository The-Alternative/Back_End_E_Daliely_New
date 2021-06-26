<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerDoctor\CusromerDoctorRequest;
use App\Service\Doctors\CustomerDoctorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CustomerDoctorController extends Controller
{
    private $CustomerDoctorService;

    public function __construct(CustomerDoctorService $CustomerDoctorService,Response $response )
    {
        $this->CustomerDoctorService=$CustomerDoctorService;
        $this->response=$response;
    }

    //PATIENT
    public function getByIdpatient($id)
    {
        return $this->CustomerDoctorService->getByIdpatient($id);
    }
    public function createpatient(CusromerDoctorRequest $request)
    {
        return $this->CustomerDoctorService->createpatient($request);
    }
    public function updatepatient(CusromerDoctorRequest $request,$id)
    {
        return $this->CustomerDoctorService->updatepatient($request,$id);
    }

    public function trashpatient($id)
    {
        return $this->CustomerDoctorService->trashpatient($id);
    }
    public function getTrashedpatient()
    {
        return $this->CustomerDoctorService->getTrashedpatient();
    }
    public function restoreTrashedpatient($id)
    {
        return $this->CustomerDoctorService->restoreTrashedpatient($id);
    }
    public function deletepatient($id)
    {
        return $this->CustomerDoctorService->restoreTrashedpatient($id);
    }
}
