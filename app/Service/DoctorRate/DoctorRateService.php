<?php


namespace App\Service\DoctorRate;

use App\Http\Requests\DoctorRate\DoctorRateRequest;
use App\Models\DoctorRate\DoctorRate;
use App\Models\Doctors\doctor;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class DoctorRateService
{
    private $DoctorRateModel;
    use GeneralTrait;


    public function __construct(DoctorRate $doctorRate)
    {

        $this->DoctorRateModel=$doctorRate;
    }

    public function getDoctorRate()
    {
        $doctorRate =DoctorRate::find(1);
        $doctorRate->doctor;
        return response()->json($doctorRate);
    }
    public function get()
    {

        $doctorRate=$this->DoctorRateModel::all();
        return $this->returnData('DoctorRate',$doctorRate,'done');

    }

    public function getById($id)
    {

        $doctorRate= $this->DoctorRateModel::find($id);
        return $this->returnData('doctorRate',$doctorRate,'done');

    }

//    public function getTrashed()
//    {
//        $doctorRate= $this->DoctorRateModel::all()->where('is_active',0);
//        return $this -> returnData('brand',$doctorRate,'done');
//    }

    public function create( DoctorRateRequest $request )
    {
       $doctorRate=new DoctorRate();

       $doctorRate->doctor_id                 =$request->doctor_id;
       $doctorRate->rate                      =$request->rate;


        $result=$doctorRate->save();
        if ($result)
        {
            return $this->returnData('doctorRate', $doctorRate,'done');
        }
        else
        {
            return $this->returnError('400', 'saving failed');
        }

    }

    public function update(DoctorRateRequest $request,$id)
    {

        $doctorRate= $this->DoctorRateModel::find($id);

        $doctorRate->doctor_id                =$request->doctor_id;
        $doctorRate->rate                     =$request->rate;


        $result=$doctorRate->save();
        if ($result)
        {
            return $this->returnData('doctorRate', $doctorRate,'done');
        }
        else
        {
            return $this->returnError('400', 'updating failed');
        }

    }


//    public function trash( $id)
//    {
//        $doctorRate= $this->DoctorRateModel::find($id);
//        $doctorRate->is_active=false;
//        $doctorRate->save();
//
//        return $this->returnData('DoctorRate', $doctorRate,'This DoctorRate is trashed Now');
//    }

//
//    public function restoreTrashed( $id)
//    {
//        $doctorRate=DoctorRate::find($id);
//        $doctorRate->is_active=true;
//        $doctorRate->save();
//
//        return $this->returnData('DoctorRate', $doctorRate,'This DoctorRate is trashed Now');
//    }

//    public function delete($id)
//    {
//       $doctorRate = DoctorRate::find($id);
//       $doctorRate->is_active = false;
//       $doctorRate->save();
//        return $this->returnData('DoctorRate', $doctorRate, 'This DoctorRate is deleted Now');
//
//    }

}
