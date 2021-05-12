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
    private $response;
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
        $response=$this->DoctorService->create($request);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

    public function update(DoctorRequest $request,$id)
    {
        $response=$this->DoctorService->update($request,$id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');

    }
    public function search($name)
    {
        $response= $this->DoctorService->search($name);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function trash($id)
    {
        $response= $this->DoctorService->trash($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function restoreTrashed($id)
    {
        $response= $this->DoctorService->restoreTrashed($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function delete($id)
    {
        $response=$this->DoctorService->delete($id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

    public function SocialMedia($doctor_name)
    {
        $response=$this->DoctorService->SocialMedia($doctor_name);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

//    public function workplace($doctor_name)
//    {
//        $response=$this->DoctorService->workplace($doctor_name);
//        return  response($response,200)
//            ->header('Access-control-Allow-Origin','*')
//            ->header('Access-control-Allow-Methods','*');
//    }
    public function doctormedicaldevice($doctor_name)
    {
        $response=$this->DoctorService->doctormedicaldevice($doctor_name);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }
    public function getalldetails($doctor_name)
    {
        $response=$this->DoctorService->getalldetails($doctor_name);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

    public function hospital($doctor_name)
    {
        $response=$this->DoctorService->hospital($doctor_name);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }



    public function appointment($doctor_name)
    {
        $response=$this->DoctorService->appointment($doctor_name);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

    public function clinic($doctor_name)
    {
        $response=$this->DoctorService->clinic($doctor_name);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

    public function customer($doctor_name)
    {
        $response=$this->DoctorService->customer($doctor_name);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');

    }

    public function createcustomer(Request $request)
    {
        $response=$this->DoctorCustomerService->create( $request );
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');

    }
}
