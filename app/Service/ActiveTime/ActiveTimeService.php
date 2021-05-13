<?php


namespace App\Service\ActiveTime;
use App\Http\Requests\ActiveTime\ActiveTimeRequest;
use App\Models\ActiveTime\ActiveTime;
use App\Traits\GeneralTrait;

class ActiveTimeService
{
    private $ActiveTimeModel;
    use GeneralTrait;


    public function __construct(ActiveTime $ActiveTime)
    {
        $this->ActiveTimeModel=$ActiveTime;
    }
    public function get()
    {
        $ActiveTime= $this->ActiveTimeModel::IsActive()->get();
        return $this->returnData('ActiveTime',$ActiveTime,'done');
    }

    public function getById($id)
    {
        $ActiveTime= $this->ActiveTimeModel::find($id)->get();
        return $this->returnData('ActiveTime',$ActiveTime,'done');
    }

    public function getTrashed()
    {
        $ActiveTime= $this->ActiveTimeModel::NotActive()->get();
        return $this -> returnData('ActiveTime',$ActiveTime,'done');
    }

    public function create( ActiveTimeRequest $request )
    {
        $ActiveTime=new ActiveTime();

        $ActiveTime->start_time                =$request->start_time;
        $ActiveTime->end_time                  =$request->end_time ;
        $ActiveTime->is_approved               =$request->is_approved;
        $ActiveTime->is_active                 =$request->is_active;


        $result=$ActiveTime->save();
        if ($result)
        {
            return $this->returnData('ActiveTime', $ActiveTime,'done');
        }
        else
        {
            return $this->returnError('400', 'saving failed');
        }
    }

    public function update(ActiveTimeRequest $request,$id)
    {
        $ActiveTime= $this->ActiveTimeModel::find($id);

        $ActiveTime->start_time                =$request->start_time;
        $ActiveTime->end_time                  =$request->end_time ;
        $ActiveTime->is_approved               =$request->is_approved;
        $ActiveTime->is_active                 =$request->is_active;

        $result=$ActiveTime->save();
        if ($result)
        {
            return $this->returnData('ActiveTime', $ActiveTime,'done');
        }
        else
        {
            return $this->returnError('400', 'updating failed');
        }
    }

    public function trash( $id)
    {
        $ActiveTime= $this->ActiveTimeModel::find($id);
        $ActiveTime->is_active=false;
        $ActiveTime->save();
        return $this->returnData('ActiveTime', $ActiveTime,'This ActiveTime is trashed Now');
    }

    public function restoreTrashed( $id)
    {
        $ActiveTime=ActiveTime::find($id);
        $ActiveTime->is_active=true;
        $ActiveTime->save();
        return $this->returnData('ActiveTime', $ActiveTime,'This ActiveTime is trashed Now');
    }

    public function delete($id)
    {
        $ActiveTime=ActiveTime::find($id);
        $ActiveTime->is_active = false;
        $ActiveTime->save();
        return $this->returnData('ActiveTime', $ActiveTime, 'This ActiveTime is deleted Now');
    }
}
