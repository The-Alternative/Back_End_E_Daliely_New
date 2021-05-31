<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Doctors\DoctorRequest;
use App\Service\Doctors\DoctorCustomerService;
use App\Service\Doctors\DoctorService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DoctorController extends Controller
{
    use GeneralTrait;
    private $DoctorService;
    private $DoctorCustomerService;

    public function __construct(DoctorService $DoctorService,DoctorCustomerService $doctorCustomerService,Response $response )
    {
        $this->DoctorCustomerService=$doctorCustomerService;
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

    public function create(DoctorRequest $request)
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

    public function SocialMedia($doctor_name)
    {
        return $this->DoctorService->SocialMedia($doctor_name);
    }

    public function doctormedicaldevice($doctor_name)
    {
        return $this->DoctorService->doctormedicaldevice($doctor_name);
    }
    public function getalldetails($doctor_name)
    {
        return $this->DoctorService->getalldetails($doctor_name);
    }

    public function hospital($doctor_name)
    {
        return $this->DoctorService->hospital($doctor_name);
    }

    public function appointment($doctor_name)
    {
        return $this->DoctorService->appointment($doctor_name);
    }

    public function clinic($doctor_name)
    {
        return $this->DoctorService->clinic($doctor_name);
    }

    public function customer($doctor_name)
    {
        return $this->DoctorService->customer($doctor_name);
    }

    public function createcustomer(Request $request,$doctorid,$fileId)
    {
        return $this->DoctorCustomerService->create( $request,$doctorid,$fileId );
    }
    public function DoctorRate($doctor_name)
    {
        return $this->DoctorService->DoctorRate($doctor_name);
    }
}
