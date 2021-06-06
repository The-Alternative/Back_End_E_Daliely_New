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

    public function get()
    {
        try{
        $doctorRate=$this->DoctorRateModel::all();
        return $this->returnData('DoctorRate',$doctorRate,'done');
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400','faild');
        }
    }

    public function getById($id)
    {
      try{
        $doctorRate= $this->DoctorRateModel::find($id);
          if (is_null($doctorRate)){
              return $this->returnSuccessMessage('this Doctor Rate not found','done');
          }
          else{
              return  $this->returnData('doctorRate',$doctorRate,'done');
          }
      }
      catch(\Exception $ex)
      {
          return $this->returnError('400','faild');
      }
    }

    public function create( DoctorRateRequest $request )
    {
        try {
            $doctorRate = new DoctorRate();
            $doctorRate->doctor_id = $request->doctor_id;
            $doctorRate->rate = $request->rate;

            $result = $doctorRate->save();
            if ($result) {
                return $this->returnData('doctorRate', $doctorRate, 'done');
            } else {
                return $this->returnError('400', 'saving failed');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400', 'failed');
        }
    }

    public function update(DoctorRateRequest $request,$id)
    {
      try{
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
    catch(\Exception $ex)
        {
           return $this->returnError('400', 'failed');
         }

    }

    public function trash( $id)
    {
        try{
        $doctorRate= $this->DoctorRateModel::find($id);
            if (is_null($doctorRate)) {
                return $this->returnSuccessMessage('This doctorRate not found', 'done');
            }
            else
            {
              $doctorRate->is_active=false;
              $doctorRate->save();
              return $this->returnData('DoctorRate', $doctorRate,'This DoctorRate is trashed Now');
            }
        }
        catch (\Exception $ex)
        {
            return $this->returnError('400', 'failed');
        }
    }
    public function getTrashed()
    {
        try {
            $doctorRate = $this->DoctorRateModel::all()->where('is_active', 0);
            return $this->returnData('brand', $doctorRate, 'done');
        }
        catch(\Exception $ex){
            return $this->returnError('400', 'failed');
        }
    }
//
    public function restoreTrashed( $id)
    {
        try {
            $doctorRate = DoctorRate::find($id);
            if (is_null($doctorRate)) {
                return $this->returnSuccessMessage('This doctorRate not found', 'done');
            } else {
                $doctorRate->is_active = true;
                $doctorRate->save();
                return $this->returnData('DoctorRate', $doctorRate, 'This DoctorRate is trashed Now');
            }
        }
            catch(\Exception $ex)
            {
                return $this->returnError('400', 'failed');
            }
    }

    public function delete($id)
    {
        try {
            $doctorRate = DoctorRate::find($id);
            if ($doctorRate->is_active == 0) {
                $doctorRate = $this->DoctorRateModel->destroy($id);
                return $this->returnData('DoctorRate', $doctorRate, 'This DoctorRate is deleted Now');
            }
        } catch (\Exception $ex) {
            return $this->returnError('400', 'failed');
        }
    }

}
