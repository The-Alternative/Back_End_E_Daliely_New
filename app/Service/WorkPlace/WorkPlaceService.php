<?php


namespace App\Service\WorkPlace;


use App\Http\Requests\WorkPlace\WorkPlaceRequest;
use App\Models\WorkPlace\WorkPlace;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class WorkPlaceService
{
    private $WorkPlaceModel;
    use GeneralTrait;


    public function __construct(WorkPlace $WorkPlace)
    {

        $this->WorkPlaceModel=$WorkPlace;
    }
    public function get()
    {

        $WorkPlace=$this->WorkPlaceModel::IsActive();
        return $this->returnData('WorkPlace',$WorkPlace,'done');

    }

    public function getById($id)
    {

        $WorkPlace= $this->WorkPlaceModel::find($id);
        return $this->returnData('WorkPlace',$WorkPlace,'done');

    }

    public function getTrashed()
    {
        $WorkPlace= $this->WorkPlaceModel::IsActive();
        return $this -> returnData('$WorkPlace',$WorkPlace,'done');
    }

    public function create( WorkPlaceRequest $request )
    {
        $WorkPlace=new WorkPlace();

        $WorkPlace->clinic          =$request->clinic;
        $WorkPlace->hospital_id     =$request->hospital_id;
        $WorkPlace->work_hours      =$request->work_hours;
        $WorkPlace->work_day        =$request->work_day;
        $WorkPlace->doctor_id       =$request->doctor_id;
        $WorkPlace->location_id     =$request->location_id;
        $WorkPlace->is_active       =$request->is_active;


        $result=$WorkPlace->save();
        if ($result)
        {
            return $this->returnData('WorkPlace', $WorkPlace,'done');
        }
        else
        {
            return $this->returnError('400', 'saving failed');
        }

    }

    public function update(WorkPlaceRequest $request,$id)
    {

        $WorkPlace= $this->WorkPlaceModel::find($id);

        $WorkPlace->clinic          =$request->clinic;
        $WorkPlace->hospital_id     =$request->hospital_id;
        $WorkPlace->work_hours      =$request->work_hours;
        $WorkPlace->work_day        =$request->work_day;
        $WorkPlace->doctor_id       =$request->doctor_id;
        $WorkPlace->location_id     =$request->location_id;
        $WorkPlace->is_active       =$request->is_active;




        $result=$WorkPlace->save();
        if ($result)
        {
            return $this->returnData('WorkPlace', $WorkPlace,'done');
        }
        else
        {
            return $this->returnError('400', 'updating failed');
        }

    }

//    public function search($name)
//    {
//        $WorkPlace = DB::table('work_places')
//            ->where("name","like","%".$name."%")
//            ->get();
//        if (!$WorkPlace)
//        {
//            return $this->returnError('400', 'not found this workPlace');
//        }
//        else
//        {
//            return $this->returnData('WorkPlace', $WorkPlace,'done');
//
//        }
//    }

    public function trash( $id)
    {
        $WorkPlace= $this->WorkPlaceModel::find($id);
        $WorkPlace->is_active=false;
        $WorkPlace->save();

        return $this->returnData('WorkPlace', $WorkPlace,'This WorkPlace is trashed Now');
    }


    public function restoreTrashed( $id)
    {
        $WorkPlace=WorkPlace::find($id);
        $WorkPlace->is_active=true;
        $WorkPlace->save();

        return $this->returnData('WorkPlace', $WorkPlace,'This WorkPlace is trashed Now');
    }

    public function delete($id)
    {
        $WorkPlace = WorkPlace::find($id);
        $WorkPlace->is_active = false;
        $WorkPlace->save();
        return $this->returnData('WorkPlace', $WorkPlace, 'This WorkPlace is deleted Now');

    }

}
