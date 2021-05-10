<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use App\Service\Doctors\DoctorCustomerService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DoctorCustomerController extends Controller
{
    use GeneralTrait;
    private $DoctorCustomerService;
    private $response;

    public function __construct(DoctorCustomerService $DoctorCustomerService,Response $response )
    {
        $this->DoctorCustomerService=$DoctorCustomerService;
        $this->response=$response;
    }
    public function createcustomer(Request $request)
    {
        return "ok";
//        $response=$this->DoctorCustomerService->createcustomer($request);
//        return  response($response,200)
//            ->header('Access-control-Allow-Origin','*')
//            ->header('Access-control-Allow-Methods','*');

    }
}
