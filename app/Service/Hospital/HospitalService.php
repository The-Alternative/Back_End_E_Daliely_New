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

        $Hospital=$this->HospitalModel::IsActive()->all();
        return $this->returnData('Hospital',$Hospital,'done');

    }

    public function getById($id)
    {

        $Hospital= $this->HospitalModel::find($id);
        return $this->returnData('Hospital',$Hospital,'done');

    }

    public function getTrashed()
    {
        $Hospital= $this->HospitalModel::all()->where('is_active',0);
        return $this -> returnData('Hospital',$Hospital,'done');
    }

    public function create( HospitalRequest $request )
    {
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

    public function update(HospitalRequest $request,$id)
    {

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

    public function search($name)
    {
        $Hospital = DB::table('hospitals')
            ->where("name","like","%".$name."%")
            ->get();
        if (!$Hospital)
        {
            return $this->returnError('400', 'not found this hospital');
        }
        else
        {
            return $this->returnData('Hospital', $Hospital,'done');

        }
    }

    public function trash( $id)
    {
        $Hospital= $this->HospitalModel::find($id);
        $Hospital->is_active=false;
        $Hospital->save();

        return $this->returnData('Hospital', $Hospital,'This Hospital is trashed Now');
    }


    public function restoreTrashed( $id)
    {
        $Hospital=Hospital::find($id);
        $Hospital->is_active=true;
        $Hospital->save();

        return $this->returnData('Hospital', $Hospital,'This Hospital is trashed Now');
    }

    public function delete($id)
    {
        $Hospital = Hospital::find($id);
        $Hospital->is_active = false;
        $Hospital->save();
        return $this->returnData('Hospital', $Hospital, 'This Hospital is deleted Now');

    }

    //get all the doctors who work in the hospital according to her name

    public function hospitalsDoctor($hospital_name)
    {
      return  Hospital::with('doctor')
                       ->where('name','like','%'.$hospital_name.'%')
                       ->get();
    }

}
