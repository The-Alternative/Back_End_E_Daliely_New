<?php


namespace App\Service\Hospital;


use App\Http\Requests\Hospital\HospitalRequest;
use App\Models\Hospital\Hospital;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class HospitalService
{
    private $HospitalModel;
    use GeneralTrait;

    public function __construct(Hospital $Hospital)
    {
        $this->HospitalModel=$Hospital;
    }
    public function get()
    {
        try {
            $Hospital = $this->HospitalModel::IsActive()->all();
            return $this->returnData('Hospital', $Hospital, 'done');
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    public function getById($id)
    {
        try{
        $Hospital= $this->HospitalModel::find($id);
        if (is_null($Hospital)){
            return $this->returnSuccessMessage('this Hospital not found','done');
        }
        else{
            return $this->returnData('Hospital',$Hospital,'done');
        }
    }
    catch(\Exception $ex)
      {
         return $this->returnError('400',$ex->getMessage());
      }
    }
    public function create( HospitalRequest $request )
    {
        try{
              $Hospital=new Hospital();

              $Hospital->name                      =$request->name;
              $Hospital->medical_center            =$request->medical_center ;
              $Hospital->general_hospital          =$request->general_hospital;
              $Hospital->private_hospital          =$request->private_hospital;
              $Hospital->location_id               =$request->location_id;
              $Hospital->doctor_id                 =$request->doctor_id;
              $Hospital->is_active                 =$request->is_active;
              $Hospital->is_approved               =$request->is_approved;

              $result=$Hospital->save();
              if ($result)
              {
                  return $this->returnData('Hospital', $Hospital,'done');
              }
              else
              {
                  return $this->returnError('400', 'saving failed');
              }
        }
          catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    public function update(HospitalRequest $request,$id)
    {
        try{
             $Hospital= $this->HospitalModel::find($id);

             $Hospital->name                      =$request->name;
             $Hospital->medical_center            =$request->medical_center ;
             $Hospital->general_hospital          =$request->general_hospital;
             $Hospital->private_hospital          =$request->private_hospital;
             $Hospital->location_id               =$request->location_id;
             $Hospital->doctor_id                 =$request->doctor_id;
             $Hospital->is_active                 =$request->is_active;
             $Hospital->is_approved               =$request->is_approved;

             $result=$Hospital->save();
             if ($result)
             {
                 return $this->returnData('Hospital', $Hospital,'done');
             }
             else
             {
                 return $this->returnError('400', 'updating failed');
             }
        }
          catch (\Exception $ex) {
              return $this->returnError('400', $ex->getMessage());
        }

    }
    public function search($name)
    {
        try {
            $Hospital = DB::table('hospitals')
                ->where("name", "like", "%" . $name . "%")
                ->get();
            if (!$Hospital) {
                return $this->returnError('400', 'not found this hospital');
            } else {
                return $this->returnData('Hospital', $Hospital, 'done');
            }
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    public function trash( $id)
    {
        try{
        $Hospital= $this->HospitalModel::find($id);
            if (is_null($Hospital)) {
                return $this->returnSuccessMessage('This Hospital not found', 'done');
            }
            else
            {
                $Hospital->is_active=0;
                $Hospital->save();
                return $this->returnData('Hospital', $id,'This Hospital is trashed Now');
            }
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }

    }
    public function getTrashed()
    {
        try{
            $Hospital= $this->HospitalModel::NotActive()->all();
            return $this -> returnData('Hospital',$Hospital,'done');
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }    }
    public function restoreTrashed( $id)
    {
        try{
        $Hospital=Hospital::find($id);
            if (is_null($Hospital)) {
                return $this->returnSuccessMessage('This Hospital not found', 'done');
            }
            else
            {
                $Hospital->is_active=1;
                $Hospital->save();
                return $this->returnData('Hospital', $id,'This Hospital is trashed Now');
            }
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }


    }
    public function delete($id)
    {
        try{
        $Hospital = Hospital::find($id);
            if ($Hospital->is_active == 0) {
                $clinic = $this->HospitalModel->destroy($id);
            }
            return $this->returnData('Hospital', $id, 'This Hospital is deleted Now');
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    //get all the doctors who work in the hospital according to her name
    public function hospitalsDoctor($hospital_name)
    {
        try{
               return  Hospital::with('doctor')
                               ->where('name','like','%'.$hospital_name.'%')
                               ->get();
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }

}
