<?php


namespace App\Service\Doctors;


use App\Http\Requests\CustomerDoctor\CusromerDoctorRequest;
use App\Models\Doctors\CustomerDoctor;
use App\Models\Doctors\doctor;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CustomerDoctorService
{
    private $CustomerDoctorModel;
    private $customerModel;
    use GeneralTrait;


    public function __construct(CustomerDoctor $patient)
    {
        $this->CustomerDoctorModel=$patient;
    }
    public function getById($id)
    {
        try{
            $patient= $this->CustomerDoctorModel->find($id);
            if (is_null($patient)){
                return $this->returnSuccessMessage('this patient not found','done');
            }
            else {
                return $this->returnData('patient', $patient, 'done');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
    public function create(CusromerDoctorRequest $request)
    {
        try {
            $patient=new CustomerDoctor();

            $patient->doctor_id           =$request->doctor_id;
            $patient->customer_id         =$request->customer_id;
            $patient->medical_file_id     =$request->medical_file_id;
            $patient->age                 =$request->age;
            $patient->gender              =$request->gender;
            $patient->social_status      =$request->social_status;
            $patient->note                =$request->note;
            $patient->blood_type          =$request->blood_type;
            $patient->is_active           =$request->is_active;
            $patient->is_approved           =$request->is_approved;

           $result= $patient->save();
           if($result) {
               return $this->returnData('patient', $patient, 'done');
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
    //__________________________________________________________
    public function update(CusromerDoctorRequest $request,$id)
    {
        try {
            $patient=$this->CustomerDoctorModel->find($id);

            $patient->doctor_id           =$request->doctor_id;
            $patient->customer_id         =$request->customer_id;
            $patient->medical_file_id     =$request->medical_file_id;
            $patient->age                 =$request->age;
            $patient->gender              =$request->gender;
            $patient->social_status      =$request->social_status;
            $patient->note                =$request->note;
            $patient->blood_type          =$request->blood_type;
            $patient->is_active           =$request->is_active;
            $patient->is_approved           =$request->is_approved;

           $result= $patient->save();

            if ($result)
            {
                return $this->returnData('Patient', $patient,'done');
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
    public function trashpatient( $id)
    {
        try{
            $patient= $this->CustomerDoctorModel::find($id);
            if(is_null($patient)){
                return $this->returnSuccessMessage('This patient not found', 'done');}
            else{
                $patient->is_active =0;
                $patient->save();
                return $this->returnData('patient', $patient, 'This patient is trashed Now');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
    public function getTrashedpatient()
    {
        try {
            $patient = $this->CustomerDoctorModel::NotActive();
            return $this->returnData('patient', $patient, 'done');
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
    public function restoreTrashedpatient( $id)
    {
        try {
            $patient = $this->CustomerDoctorModel::find($id);
            if (is_null($patient)) {
                return $this->returnSuccessMessage('This patient not found', 'done');
            } else {
                $patient->is_active =1;
                $patient->save();
                return $this->returnData('patient', $patient, 'This patient is restore trashed Now');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
    public function deletepatient($id)
    {
        try{
            $patient = $this->CustomerDoctorModel::find($id);
            if ($patient->is_active == 0) {
                $patient->delete();
                return $this->returnData('patient', $patient, 'This patient is deleted Now');

            }
            else {
                return $this->returnData('patient', $patient, 'This patient can not deleted Now');
            }
        } catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }

    }
}
//$doctor=doctor::find($request->doctor_id);
//        if(!$doctor)
//            return "error";
//        $doctor->customer()->sync($request->customer_id);
//        return " success";
