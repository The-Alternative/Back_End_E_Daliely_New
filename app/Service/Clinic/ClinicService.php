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
        try
        {
        $clinic= $this->ClinicModel->get();
        return $this->returnData('clinic',$clinic,'done');
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400','failed');
        }
    }

    public function getById($id)
    {
        try
        {
        $clinic= $this->ClinicModel->find($id);
        if (is_null($clinic)){
        return $this->returnSuccessMessage('this clinic not found','done');
        }
        else{
            return  $this->returnData('clinic',$clinic,'done');
        }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400','failed');
        }

    }


//___________________________________________________________________//
//    public function create( ClinicRequest $request )
//    {
//        try {
//            $allclinic= collect($request->clinic)->all();
//            DB::beginTransaction();
//            $unTransclinic_id = Clinic::insertGetId([
//                'location_id' => $request['location_id'],
//                'doctor_id' => $request['doctor_id'],
//                'phone_number' => $request['phone_number'],
//                'is_approved' => $request['is_approved'],
//                'active_time_id'=>$request['active_time_id'],
//                'is_active' => $request['is_active'],
//            ]);
//            if (isset($allclinic)) {
//                foreach ($allclinic as $allclinics) {
//                    $transclinic[] = [
//                        'name' => $allclinics['name'],
//                        'locale' => $allclinics['locale'],
//                        'clinic_id' => $unTransclinic_id,
//                    ];
//                }
//                ClinicTranslation::insert($transclinic);
//            }
//            DB::commit();
//            return $this->returnData('Clinic', [$unTransclinic_id, $transclinic], 'done');
//        }
//        catch(\Exception $ex)
//        {
//            DB::rollback();
//            return $this->returnError('Clinic', 'failed');
//        }
//    }
////______________________________________________________________//
//    public function update(ClinicRequest $request,$id)
//    {
//        try{
//            $clinic=Clinic::find($id);
//            if(!$clinic)
//                return $this->returnError('400', 'not found this Clinic');
//            $allclinic= collect($request->Clinic)->all();
//            if (!($request->has('clinic.is_active')))
//                $request->request->add(['is_active'=>0]);
//            else
//                $request->request->add(['is_active'=>1]);
//
//            $newclinic=Clinic::where('id',$id)
//                ->update([
//                    'location_id' => $request['location_id'],
//                    'doctor_id' => $request['doctor_id'],
//                    'phone_number' => $request['phone_number'],
//                    'active_time_id'=>$request['active_time_id'],
//                    'is_approved' => $request['is_approved'],
//                    'is_active' => $request['is_active'],
//                ]);
//
//            $ss=ClinicTranslation::where('clinic_id',$id);
//            $collection1 = collect($allclinic);
//            $alldoctorlength=$collection1->count();
//            $collection2 = collect($ss);
//
//            $db_clinic= array_values(ClinicTranslation::where('clinic_id',$id)
//                ->get()
//                ->all());
//            $dbclinic = array_values($db_clinic);
//            $request_clinic= array_values($request->clinic);
//            foreach($dbclinic as $dbclinics){
//                foreach($request_clinic as $request_clinics){
//                    $values= ClinicTranslation::where('clinic_id',$id)
//                        ->where('locale',$request_clinics['locale'])
//                        ->update([
//                            'name' => $request_clinics ['name'],
//                            'locale' => $request_clinics['locale'],
//                            'clinic_id' => $id,
//                        ]);
//                }
//            }
//            DB::commit();
//            return $this->returnData('Clinic', $dbclinic,'done');
//        }
//        catch(\Exception $ex){
//            return $this->returnError('400', 'saving failed');
//        }
//    }
////_________________________________________________________________//
//    public function search($name)
//    {
//        try {
//            $clinic = DB::table('clinics')
//                ->where("name", "like", "%" . $name . "%")
//                ->get();
//            if (!$clinic) {
//                return $this->returnError('400', 'not found this doctor');
//            } else {
//                return $this->returnData('clinic', $clinic, 'done');
//            }
//        }
//        catch(\Exception $ex){
//            return $this->returnError('400','failed');
//        }
//    }
//    public function trash( $id)
//    {
//        try {
//        $clinic= $this->ClinicModel::find($id);
//            if (is_null($clinic)) {
//                return $this->returnSuccessMessage('This Appointment not found', 'done');
//            }
//           else
//            {
//                $clinic->is_active=false;
//                $clinic->save();
//                return $this->returnData('clinic', $clinic,'This clinic is trashed Now');
//            }
//         }
//       catch (\Exception $ex)
//       {
//         return $this->returnError('400', 'failed');
//        }
//    }
//    public function getTrashed()
//    {
//        try {
//              $clinic= $this->ClinicModel->NotActive()->get();
//              return $this -> returnData('clinic',$clinic,'done');
//        }
//        catch (\Exception $ex)
//        {
//            return $this->returnError('400', 'failed');
//        }
//    }
//    public function restoreTrashed( $id)
//    {
//        try {
//             $clinic=Clinic::find($id);
//            if (is_null($clinic)) {
//                return $this->returnSuccessMessage('This clinic not found', 'done');
//            }
//        else
//        {
//             $clinic->is_active=true;
//             $clinic->save();
//              return $this->returnData('clinic', $clinic,'This clinic is trashed Now');
//         }
//        }
//        catch (\Exception $ex)
//      {
//        return $this->returnError('400', 'failed');
//      }
//    }
//
//    public function delete($id)
//    {
//        try {
//            $clinic = Clinic::find($id);
//            if ($clinic->is_active == 0) {
//                $clinic = $this->ClinicModel->destroy($id);
//            }
//            return $this->returnData('clinic', $clinic, 'This clinic Is deleted Now');
//
//        }
//        catch (\Exception $ex) {
//            return $this->returnError('400', 'failed');
//        }
//    }

}
