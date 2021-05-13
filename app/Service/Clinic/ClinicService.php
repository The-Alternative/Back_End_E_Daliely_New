<?php


namespace App\Service\Clinic;


use App\Http\Requests\Clinic\ClinicRequest;
use App\Models\Clinic\Clinic;
use App\Models\Clinic\ClinicTranslation;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class ClinicService
{
    private $ClinicModel;
    use GeneralTrait;


    public function __construct(Clinic $clinic)
    {
        $this->ClinicModel=$clinic;
    }
    public function get()
    {
        $clinic= $this->ClinicModel::Active()->WithTrans()->get();
        return $this->returnData('clinic',$clinic,'done');
    }

    public function getById($id)
    {
        $clinic= $this->ClinicModel::WithTrans()->find($id);
        return $this->returnData('clinic',$clinic,'done');
    }

    public function getTrashed()
    {
        $clinic= $this->ClinicModel::all()->where('is_active',0);
        return $this -> returnData('clinic',$clinic,'done');
    }
//___________________________________________________________________//
    public function create( ClinicRequest $request )
    {
        try {
            $allclinic= collect($request->clinic)->all();
            DB::beginTransaction();
            $unTransclinic_id = Clinic::insertGetId([
                'location_id' => $request['location_id'],
                'doctor_id' => $request['doctor_id'],
                'phone_number' => $request['phone_number'],
                'is_approved' => $request['is_approved'],
                'active_time_id'=>$request['active_time_id'],
                'is_active' => $request['is_active'],
            ]);
            if (isset($allclinic)) {
                foreach ($allclinic as $allclinics) {
                    $transclinic[] = [
                        'name' => $allclinics['name'],
                        'locale' => $allclinics['locale'],
                        'clinic_id' => $unTransclinic_id,
                    ];
                }
                ClinicTranslation::insert($transclinic);
            }
            DB::commit();
            return $this->returnData('Clinic', [$unTransclinic_id, $transclinic], 'done');
        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return $this->returnError('Clinic', 'faild');
        }
    }
//______________________________________________________________//
    public function update(ClinicRequest $request,$id)
    {
//        try{
            $clinic= Clinic::find($id);
            if(!$clinic)
                return $this->returnError('400', 'not found this Clinic');
            $allclinic= collect($request->Clinic)->all();
            if (!($request->has('clinic.is_active')))
                $request->request->add(['is_active'=>0]);
            else
                $request->request->add(['is_active'=>1]);

            $newclinic=Clinic::where('id',$id)
                ->update([
                    'location_id' => $request['location_id'],
                    'doctor_id' => $request['doctor_id'],
                    'phone_number' => $request['phone_number'],
                    'active_time_id'=>$request['active_time_id'],
                    'is_approved' => $request['is_approved'],
                    'is_active' => $request['is_active'],
                ]);

            $ss=ClinicTranslation::where('clinic_id',$id);
            $collection1 = collect($allclinic);
            $alldoctorlength=$collection1->count();
            $collection2 = collect($ss);

            $db_clinic= array_values(ClinicTranslation::where('clinic_id',$id)
                ->get()
                ->all());
            $dbclinic = array_values($db_clinic);
            $request_clinic= array_values($request->clinic);
            foreach($dbclinic as $dbclinics){
                foreach($request_clinic as $request_clinics){
                    $values= ClinicTranslation::where('clinic_id',$id)
                        ->where('locale',$request_clinics['locale'])
                        ->update([
                            'name' => $request_clinics ['name'],
                            'locale' => $request_clinics['locale'],
                            'clinic_id' => $id,
                        ]);
                }
            }
//            DB::commit();
            return $this->returnData('Clinic', $dbclinic,'done');

//        }
//        catch(\Exception $ex){
//            return $this->returnError('400', 'saving failed');
//        }
    }
//_________________________________________________________________//
    public function search($name)
    {
        $clinic = DB::table('clinics')
            ->where("name","like","%".$name."%")
            ->get();
        if (!$clinic)
        {
            return $this->returnError('400', 'not found this doctor');
        }
        else
        {
            return $this->returnData('clinic', $clinic,'done');
        }
    }

    public function trash( $id)
    {
        $clinic= $this->ClinicModel::find($id);
        $clinic->is_active=false;
        $clinic->save();
        return $this->returnData('clinic', $clinic,'This clinic is trashed Now');
    }

    public function restoreTrashed( $id)
    {
       $clinic=Clinic::find($id);
       $clinic->is_active=true;
       $clinic->save();
        return $this->returnData('clinic', $clinic,'This clinic is trashed Now');
    }

    public function delete($id)
    {
        $clinic = Clinic::find($id);
        $clinic->is_active = false;
        $clinic->save();
        return $this->returnData('clinic', $clinic, 'This clinic is deleted Now');
    }

}
