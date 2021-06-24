<?php


namespace App\Service\Doctors;

use App\Models\Doctors\DoctorCustomer;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorCustomerService
{
    private $doctorCustomerModel;
    private $customerModel;
    use GeneralTrait;


    public function __construct(DoctorCustomer $doctorcustomer)
    {
        $this->doctorCustomerModel=$doctorcustomer;
    }

        public function create(Request $request)
        {
            return "ok";
//            try {
//
//                $customer=new DoctorCustomer();
//                $customer->doctor_id           =$request->doctor_id;
//                $customer->customer_id         =$request->customer_id;
//                $customer->medical_file_id     =$request->medical_file_id;
//                $customer->age                 =$request->age;
//                $customer->gender              =$request->gender;
//                $customer->social_statuse      =$request->social_statuse;
//                $customer->note                =$request->note;
//                $customer->blood_type          =$request->blood_type;
//                $customer->is_active           =$request->is_active;
//                $customer->is_appear           =$request->is_appear;
//
//                $customer->save();
//
//                return  $this->returnData('patient',$customer,'done');
//            }
//            catch(\Exception $ex)
//            {
//                return $this->returnError('400',$ex->getMessage());
//            }
      }
}

