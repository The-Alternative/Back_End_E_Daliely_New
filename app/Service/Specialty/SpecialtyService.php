<?php


namespace App\Service\Specialty;


use App\Http\Requests\Specialty\SpecialtyRequest;
use App\Models\Doctors\doctor;
use App\Models\Doctors\DoctorTranslation;
use App\Models\medicalDevice\medicalDevice;
use App\Models\medicalDevice\MedicalDeviceTranslation;
use App\Models\Specialty\Specialty;
use App\Models\Specialty\SpecialtyTranslation;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class SpecialtyService
{
    private $SpecialtyModel;
    use GeneralTrait;


    public function __construct(Specialty $Specialty)
    {
        $this->SpecialtyModel=$Specialty;
    }
    public function get()
    {
        try {
            $Specialty = $this->SpecialtyModel::IsActive()->WithTrans()->get();
            return $this->returnData(' Specialty', $Specialty, 'done');
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }

    }
    public function getById($id)
    {
        try{
        $Specialty= $this->SpecialtyModel::WithTrans()->find($id);
            if (is_null($Specialty)){
                return $this->returnSuccessMessage('this Social Media not found','done');
            }
            else{
                return $this->returnData(' Specialty', $Specialty,'done');
            }
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }

//_____________________________________________________________________//
    public function create( SpecialtyRequest $request )
    {
        try {
            $allspecialty = collect($request->specialty)->all();
            DB::beginTransaction();
            $unTransspecialty_id = Specialty::insertGetId([
                'graduation_year' => $request['graduation_year'],
                'is_active' => $request['is_active'],
            ]);
            if (isset($allspecialty)) {
                foreach ($allspecialty as $allspecialties) {
                    $transspecialty[] = [
                        'name' => $allspecialties ['name'],
                        'description' => $allspecialties ['description'],
                        'locale' => $allspecialties['locale'],
                        'specialty_id' => $unTransspecialty_id,
                    ];
                }
               SpecialtyTranslation::insert($transspecialty);
            }
            DB::commit();
            return $this->returnData('Specialty', [$unTransspecialty_id, $transspecialty], 'done');
        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return $this->returnError('Specialty', $ex->getMessage());
        }
    }
//_________________________________________________________//
    public function update(SpecialtyRequest $request,$id)
    {
        try{
            $specialty= Specialty::find($id);
            if(!$specialty)
                return $this->returnError('400', 'not found this Specialty');
            $allspecialty = collect($request->specialty)->all();
            if (!($request->has('specialties.is_active')))
                $request->request->add(['is_active'=>0]);
            else
                $request->request->add(['is_active'=>1]);

            $newspecialty=Specialty::where('id',$id)
                ->update([
                    'graduation_year' => $request['graduation_year'],
                    'is_active' => $request['is_active'],
                ]);
            $ss=SpecialtyTranslation::where('specialty_id',$id);
            $collection1 = collect($allspecialty);
            $alldoctorlength=$collection1->count();
            $collection2 = collect($ss);
            $db_specialty= array_values(SpecialtyTranslation::where('specialty_id',$id)
                ->get()
                ->all());
            $dbspecialty = array_values($db_specialty);
            $request_specialty= array_values($request->specialty);
            foreach($dbspecialty as $dbspecialties){
                foreach($request_specialty as $request_specialties){
                    $values= SpecialtyTranslation::where('specialty_id',$id)
                        ->where('locale',$request_specialties['locale'])
                        ->update([
                            'name' => $request_specialties ['name'],
                            'description' => $request_specialties ['description'],
                            'locale' => $request_specialties['locale'],
                            'specialty_id' => $id,
                        ]);
                }
            }
            DB::commit();
            return $this->returnData('Specialty', $dbspecialty,'done');
        }
        catch(\Exception $ex){
            return $this->returnError('400', 'saving failed');
        }
    }
//__________________________________________________________________________//
    public function search($name)
    {
        try{
        $Specialty = DB::table('specialties')
            ->where("name","like","%".$name."%")
            ->get();
        if (! $Specialty)
        {
            return $this->returnError('400', 'not found this Specialty');
        }
        else
        {
            return $this->returnData('Specialty',  $Specialty,'done');

        }
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    public function trash( $id)
    {
        try{
        $Specialty= $this->SpecialtyModel::find($id);
            if (is_null($Specialty)) {
                return $this->returnSuccessMessage('This Specialty not found', 'done');
            }
            else
            {
                $Specialty->is_active=0;
                $Specialty->save();
                return $this->returnData('Specialty',  $Specialty,'This Specialty is trashed Now');
            }
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    public function getTrashed()
    {
        try{
        $Specialty= $this->SpecialtyModel::NotActive()->get();
        return $this -> returnData('Specialty', $Specialty,'done');
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    public function restoreTrashed( $id)
    {
        try{
        $Specialty=Specialty::find($id);
            if (is_null($Specialty)) {
                return $this->returnSuccessMessage('This Social Media not found', 'done');
            }
            else
            {
                $Specialty->is_active=1;
                $Specialty->save();
                return $this->returnData('Specialty',  $Specialty,'This Specialty is trashed Now');
            }
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    public function delete($id)
    {
        try{
        $Specialty = Specialty::find($id);
            if ($Specialty->is_active == 0) {
                $Specialty = $this->SpecialtyModel->destroy($id);
            }
        return $this->returnData('Specialty',  $id, 'This Specialty is deleted Now');
    }
    catch (\Exception $ex) {
     return $this->returnError('400', $ex->getMessage());
     }
    }

    public function DoctorSpecialty($specialty_name)
    {
        try {
            return Specialty::with('doctor')
                ->join('specialty_translation','specialty_translation.specialty_id','=','specialty_id')
                ->where('specialty_translation.name','like','%'.$specialty_name.'%')
                ->select('specialties.*','specialty_translation.name')->get();
        } catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
}
