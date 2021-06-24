<?php


namespace App\Service\Doctors;


use App\Models\Doctors\CustomerDoctor;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CustomerDoctorService
{
    private $CustomerDoctorModel;
    private $customerModel;
    use GeneralTrait;


    public function __construct(CustomerDoctor $doctorcustomer)
    {
        $this->doctorCustomerModel=$doctorcustomer;
    }

    public function create(Request $request)
    {

        try {

            $customer=new CustomerDoctor();
            $customer->doctor_id           =$request->doctor_id;
            $customer->customer_id         =$request->customer_id;
            $customer->medical_file_id     =$request->medical_file_id;
            $customer->age                 =$request->age;
            $customer->gender              =$request->gender;
            $customer->social_status      =$request->social_status;
            $customer->note                =$request->note;
            $customer->blood_type          =$request->blood_type;
            $customer->is_active           =$request->is_active;
            $customer->is_approved           =$request->is_approved;

           $result= $customer->save();
           if($result) {
               return $this->returnData('patient', $customer, 'done');
           }
           else{
               return $this->returnError('400', 'saving failed');
           }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
    public function update(Request $request,$id)
    {
        try {
           $customer=$this->CustomerDoctorModel->find($id);

            $customer->doctor_id           =$request->doctor_id;
            $customer->customer_id         =$request->customer_id;
            $customer->medical_file_id     =$request->medical_file_id;
            $customer->age                 =$request->age;
            $customer->gender              =$request->gender;
            $customer->social_status      =$request->social_status;
            $customer->note                =$request->note;
            $customer->blood_type          =$request->blood_type;
            $customer->is_active           =$request->is_active;
            $customer->is_approved           =$request->is_approved;

           $result= $customer->save();

            if ($result)
            {
                return $this->returnData('Patient', $result,'done');
            }
            else
            {
                return $this->returnError('400', 'updating failed');
            }        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
}
