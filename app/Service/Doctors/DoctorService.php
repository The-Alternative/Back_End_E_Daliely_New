<?php


namespace App\Service\Doctors;

use App\Models\Customer\Customer;
use App\Models\DoctorRate\DoctorRate;
use App\Models\Doctors\Doctor;
use App\Models\Doctors\DoctorTranslation;
use App\Models\MedicalFile\MedicalFile;
use App\Traits\GeneralTrait;
use App\Http\Requests\Doctors\DoctorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DoctorService
{
    private $DoctorModel;
    private $customerModel;
    use GeneralTrait;


    public function __construct(Doctor $doctor,customer $customer)
    {
        $this->DoctorModel=$doctor;
        $this->customerModel=$customer;
    }
    public function get()
    {
        try{
        $doctor= $this->DoctorModel::paginate(5);
        return $this->returnData('doctor',$doctor,'done');
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }

    public function getById($id)
    {
        try{
            return  Doctor::with('Specialty','clinic','medicalDevice','socialMedia','hospital')->find($id);
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
////__________________________________________________________________________//
    public function create( DoctorRequest $request )
    {
        try {
            $alldoctor = collect($request->doctor)->all();
            DB::beginTransaction();
            $unTransdoctor_id =doctor::insertGetId([
                'image' => $request['image'],
                'social_media_id' => $request['social_media_id'],
                'appointments_id' => $request['appointments_id'],
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
            return $this->returnData('doctor', [$unTransdoctor_id, $transdoctor], 'done');
        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return $this->returnError('doctor', $ex->getMessage());
        }
    }
//_________________________________________________________//
    public function update(DoctorRequest $request,$id)
    {
        try{
            $doctor= Doctor::find($id);
            if(!$doctor)
                return $this->returnError('400', 'not found this doctor');
            $alldoctor = collect($request->doctor)->all();
            if (!($request->has('doctors.is_active')))
                $request->request->add(['is_active'=>0]);
            else
                $request->request->add(['is_active'=>1]);

            $newdoctor=Doctor::where('doctors.id',$id)
                ->update([
                    'image' => $request['image'],
                    'social_media_id' => $request['social_media_id'],
                    'appointments_id' => $request['appointments_id'],
                    'hospital_id' => $request['hospital_id'],
                    'clinic_id' => $request['clinic_id'],
                    'specialty_id' => $request['specialty_id'],
                    'is_approved' => $request['is_approved'],
                    'is_active' => $request['is_active'],
                ]);

            $ss=DoctorTranslation::where('doctor_translation.doctor_id',$id);
            $collection1 = collect($alldoctor);
            $alldoctorlength=$collection1->count();
            $collection2 = collect($ss);

            $db_doctor= array_values(DoctorTranslation::where('doctor_translation.doctor_id',$id)
                ->get()
                ->all());
            $dbdoctor = array_values($db_doctor);
            $request_doctor= array_values($request->doctor);
            foreach($dbdoctor as $dbdoctors){
                foreach($request_doctor as $request_doctors){
                    $values= DoctorTranslation::where('doctor_translation.doctor_id',$id)
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
            return $this->returnError('400', $ex->getMessage());
        }
    }
//___________________________________________________________//
    public function search($name)
    {
        try {
            $doctor = DB::table('doctor_translation')
                ->where("first_name", "like", "%" . $name . "%")
                ->get();
            if (!$doctor) {
                return $this->returnError('400', 'not found this doctor');
            } else {
                return $this->returnData('doctor', $doctor, 'done');
            }
        }
        catch(\Exception $ex)
            {
                return $this->returnError('400',$ex->getMessage());
            }
    }

    public function trash( $id)
    {
        try{
         $doctor= $this->DoctorModel::find($id);
        if(is_null($doctor)){
            return $this->returnSuccessMessage('This doctor not found', 'done');}
        else{
        $doctor->is_active =0;
        $doctor->save();
        return $this->returnData('doctor', $doctor, 'This doctor is trashed Now');
    }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }

    public function getTrashed()
    {
        try {
            $doctor = $this->DoctorModel::NotActive();
            return $this->returnData('doctor', $doctor, 'done');
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }

    public function restoreTrashed( $id)
    {
        try {
            $doctor = $this->DoctorModel::find($id);
            if (is_null($doctor)) {
                return $this->returnSuccessMessage('This doctor not found', 'done');
            } else {
                $doctor->is_active =1;
                $doctor->save();
                return $this->returnData('doctor', $doctor, 'This doctor is trashed Now');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }

    public function delete($id)
    {
        try{
        $doctor = $this->DoctorModel::find($id);
            if ($doctor->is_active == 0) {
                $doctor->delete();
                $doctor->doctortranslation()->delete();
                return $this->returnData('doctor', $doctor, 'This doctor is deleted Now');

            }
            else {
                return $this->returnData('doctor', $doctor, 'This doctor can not deleted Now');
            }
        } catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }

    }

//    get all doctor's social media by doctor's id
    public function SocialMedia($id)
    {
        try {
           return Doctor::with('socialMedia')->find($id);
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }


    //get  doctor's medical devices by doctor's id
    public function doctormedicaldevice($id)
    {
        try{
            return Doctor::with('medicalDevice')->find($id);
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }

    //get hospital by doctor's id
    public function hospital($id)
    {
      try{
          return Doctor::with('hospital')->find($id);
      }
      catch (\Exception $ex) {
           return $this->returnError('400', $ex->getMessage());
       }
    }

    //get doctor's appopintment
    public function appointment($id)
    {
        try{
            return Doctor::with('appointment')->find($id);
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }

    //get clinic by doctor's id
    public function clinic($id)
    {
        try{
            return Doctor::with('clinic')->find($id);
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }

    //get paitent by doctor's id
    public function customer($id)
    {
        try{
        return  Doctor::with('customer')->find($id);
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }

    //get doctor rate by doctor's id
    public function DoctorRate($id)
    {
        try{
      return Doctor::with('DoctorRate')->find($id);
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    //get specialty by doctor id
    public function DoctorSpecialty($id)
    {
        try {
            return Doctor::with('Specialty')->find($id);

        } catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
}
