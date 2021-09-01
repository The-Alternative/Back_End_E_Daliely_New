<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerDoctor\CusromerDoctorRequest;
use App\Http\Requests\CustomerDoctor\CustomerDoctorRequest;
use App\Http\Requests\Doctors\DoctorRequest;
use App\Service\Doctors\CustomerDoctorService;
use App\Service\Doctors\DoctorService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DoctorController extends Controller
{
    use GeneralTrait;
    private $DoctorService;


    public function __construct(DoctorService $DoctorService,CustomerDoctorService $CustomerDoctorService,Response $response )
    {
        $this->CustomerDoctorService=$CustomerDoctorService;
        $this->DoctorService=$DoctorService;
        $this->response=$response;
    }

    public function get()
    {
        return $this->DoctorService->get();
    }

    public function  getById($id)
    {
        return $this->DoctorService->getById($id);
    }

    public function getTrashed()
    {
        return  $this->DoctorService->getTrashed();
    }

    public function create(DoctorRequest  $request)
    {
        return $this->DoctorService->create($request);
    }

    public function update(DoctorRequest $request,$id)
    {
        return $this->DoctorService->update($request,$id);
    }
    public function search($name)
    {
        return  $this->DoctorService->search($name);
    }

    public function trash($id)
    {
        return $this->DoctorService->trash($id);
    }

    public function restoreTrashed($id)
    {
        return $this->DoctorService->restoreTrashed($id);
    }

    public function delete($id)
    {
        return $this->DoctorService->delete($id);
    }

    public function SocialMedia($id)
    {
        return $this->DoctorService->SocialMedia($id);
    }

    public function doctormedicaldevice($id)
    {
        return $this->DoctorService->doctormedicaldevice($id);
    }
    public function getalldetails($id)
    {
        return $this->DoctorService->getalldetails($id);
    }

    public function hospital($id)
    {
        return $this->DoctorService->hospital($id);
    }

    public function appointment($id)
    {
        return $this->DoctorService->appointment($id);
    }

    public function clinic($id)
    {
        return $this->DoctorService->clinic($id);
    }

    public function customer($id)
    {
        return $this->DoctorService->customer($id);
    }
    public function DoctorRate($id)
    {
        return $this->DoctorService->DoctorRate($id);
    }
    public function DoctorSpecialty($id)
    {
        return $this->DoctorService->DoctorSpecialty($id);
    }

}
