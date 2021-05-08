<?php


namespace App\Service\Doctors;

use App\Models\Doctors\doctor;
use App\Models\Doctors\DoctorTranslation;
use App\Service\Brands\BrandsService;
use App\Traits\GeneralTrait;
use App\Http\Requests\Doctors\DoctorRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DoctorService
{
    private $doctorModel;
    use GeneralTrait;


    public function __construct(doctor $doctor)
    {
        $this->doctorModel=$doctor;
    }
    public function get()
    {
        $doctor= $this->doctorModel::Active()->WithTrans();
        return $this->returnData('doctor',$doctor,'done');
    }

    public function getById($id)
    {
        $doctor= $this->doctorModel::WithTrans()->find($id);
        return $this->returnData('doctor',$doctor,'done');
    }

    public function getTrashed()
    {
        $doctor= $this->doctorModel::all()->where('is_active',0);
        return $this -> returnData('doctor',$doctor,'done');
    }
//__________________________________________________________________________//

    public function create( DoctorRequest $request )
    {
        try {
            $alldoctor = collect($request->doctor)->all();
            DB::beginTransaction();
            $unTransdoctor_id =doctor::insertGetId([
                'image' => $request['image'],
                'social_media_id' => $request['social_media_id'],
                'hospital_id' => $request['hospital_id'],
                'clinic_id' => $request['clinic_id'],
                'specialty_id' => $request['specialty_id'],
                'is_approved' => $request['is_approved'],
                'is_active' => $request['is_active'],
            ]);
            if (isset($alldoctor)) {
                foreach ($alldoctor as $alldoctors) {
                    $transdoctor[] = [
                        'first_name' => $alldoctors ['first_name'],
                        'last_name' => $alldoctors ['last_name'],
                        'description' => $alldoctors ['description'],
                        'locale' => $alldoctors['locale'],
                        'doctor_id' => $unTransdoctor_id,
                    ];
                }
                DoctorTranslation::insert( $transdoctor);
            }
            DB::commit();
            return $this->returnData('doctor', [$unTransdoctor_id,  $transdoctor], 'done');
        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return $this->returnError('doctor', 'faild');
        }
    }
//_________________________________________________________//
    public function update(DoctorRequest $request,$id)
    {
        try{
            $doctor= doctor::find($id);
            if(!$doctor)
                return $this->returnError('400', 'not found this doctor');
            $alldoctor = collect($request->doctor)->all();
            if (!($request->has('doctors.is_active')))
                $request->request->add(['is_active'=>0]);
            else
                $request->request->add(['is_active'=>1]);

            $newdoctor=doctor::where('id',$id)
                ->update([
                    'image' => $request['image'],
                    'social_media_id' => $request['social_media_id'],
                    'hospital_id' => $request['hospital_id'],
                    'clinic_id' => $request['clinic_id'],
                    'specialty_id' => $request['specialty_id'],
                    'is_approved' => $request['is_approved'],
                    'is_active' => $request['is_active'],
                ]);

            $ss=DoctorTranslation::where('doctor_id',$id);
            $collection1 = collect($alldoctor);
            $alldoctorlength=$collection1->count();
            $collection2 = collect($ss);

            $db_doctor= array_values(DoctorTranslation::where('doctor_id',$id)
                ->get()
                ->all());
            $dbdoctor = array_values($db_doctor);
            $request_doctor= array_values($request->doctor);
            foreach($dbdoctor as $dbdoctors){
                foreach($request_doctor as $request_doctors){
                    $values= DoctorTranslation::where('doctor_id',$id)
                        ->where('locale',$request_doctors['locale'])
                        ->update([
                            'first_name' => $request_doctors ['first_name'],
                            'last_name' => $request_doctors ['last_name'],
                            'description' => $request_doctors ['description'],
                            'locale' => $request_doctors['locale'],
                            'doctor_id' => $id,
                        ]);
                }
            }
            DB::commit();
            return $this->returnData('doctor', $dbdoctor,'done');

        }
        catch(\Exception $ex){
                        return $this->returnError('400', 'saving failed');
        }
    }
//___________________________________________________________//
    public function search($name)
    {
        $doctor = DB::table('doctor_translation')
            ->where("first_name","like","%".$name."%")
            ->get();
        if (!$doctor)
        {
            return $this->returnError('400', 'not found this doctor');
        }
        else
        {
            return $this->returnData('doctor', $doctor,'done');
        }
    }

    public function trash( $id)
    {
        $doctor= $this->doctorModel::find($id);
        $doctor->is_active=false;
        $doctor->save();
        return $this->returnData('doctor', $doctor,'This doctor is trashed Now');
    }

    public function restoreTrashed( $id)
    {
        $doctor=doctor::find($id);
        $doctor->is_active=true;
        $doctor->save();
        return $this->returnData('doctor', $doctor,'This doctor is trashed Now');
    }

    public function delete($id)
    {
        $doctor = doctor::find($id);
        $doctor->is_active = false;
        $doctor->save();
        return $this->returnData('doctor', $doctor, 'This doctor is deleted Now');
    }

//    get all doctor's social media by doctor's name

    public function SocialMedia($doctor_name)
    {
        return doctor::with('socialMedia')->join('doctor_translation','doctor_translation.doctor_id','=','doctor_id')
            ->where('doctor_translation.first_name','like','%'.$doctor_name.'%')
            ->select('doctors.*','doctor_translation.*')->get();
    }

    //get  doctor's work place by doctor's name
//    public function workplace($doctor_name)
//    {
//        return doctor::with('workPlace')
//                     ->where("name","like","%".$doctor_name."%")
//                     ->get();
//    }

    //get  doctor's medical devices by doctor's name

    public function doctormedicaldevice($doctor_name)
    {
        return doctor::with('medicalDevice')->join('doctor_translation','doctor_translation.doctor_id','=','doctor_id')
            ->where('doctor_translation.first_name','like','%'.$doctor_name.'%')
            ->select('doctors.*','doctor_translation.*')->get();

    }
    public function hospital($doctor_name)
    {
//
         return doctor::with('hospital')->join('doctor_translation','doctor_translation.doctor_id','=','doctor_id')
            ->where('doctor_translation.first_name','like','%'.$doctor_name.'%')
            ->select('doctors.*','doctor_translation.*')->get();

    }

    //get doctor's appopintment

//
    public function appointment($doctor_name)
    {
        return doctor::with('appointment')->join('doctor_translation','doctor_translation.doctor_id','=','doctor_id')
            ->where('doctor_translation.first_name','like','%'.$doctor_name.'%')
            ->select('doctors.*','doctor_translation.*')->get();
    }
    public function clinic($doctor_name)
    {
        return doctor::with('clinic')->join('doctor_translation','doctor_translation.doctor_id','=','doctor_id')
            ->where('doctor_translation.first_name','like','%'.$doctor_name.'%')
            ->select('doctors.*','doctor_translation.*')->get();
    }


    //get all doctor's details by doctor's name

    public function getalldetails($doctor_name)
    {
        return  doctor::with('medicalDevice','socialMedia','clinic','hospital')
            ->join('doctor_translation','doctor_translation.doctor_id','=','doctor_id')
            ->where('doctor_translation.first_name','like','%'.$doctor_name.'%')
            ->select('doctors.*','doctor_translation.*')->get();
    }
}
