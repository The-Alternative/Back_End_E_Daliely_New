<?php


namespace App\Service\Doctors;

use App\Models\Customer\Customer;
use App\Models\DoctorRate\DoctorRate;
use App\Models\Doctors\doctor;
use App\Models\Doctors\DoctorCustomer;
use App\Models\Doctors\DoctorTranslation;
use App\Service\Brands\BrandsService;
use App\Traits\GeneralTrait;
use App\Http\Requests\Doctors\DoctorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DoctorService
{
    private $doctorModel;
    private $customerModel;
    use GeneralTrait;


    public function __construct(doctor $doctor,customer $customer)
    {
        $this->doctorModel=$doctor;
        $this->customerModel=$customer;
    }
    public function get()
    {
        try{
        $doctor= $this->doctorModel::Active()->WithTrans();
        return $this->returnData('doctor',$doctor,'done');
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400','failed');
        }
    }

//$doctor= $this->doctorModel->with('medicalDevice','medicalDevice','clinic','hospital','Specialty')
//->join('doctor_translation','doctor_translation.doctor_id','=','doctor_id')
//->where('doctors.id','=',$id)
//->select('doctors.*','doctor_translation.first_name','doctor_translation.last_name','doctor_translation.description')
//->get()
//
//->find($id);
    public function getById($id)
    {

        try{
           $doctor= $this->doctorModel->withtrans()->find($id);
            if (is_null($doctor)){
                return $this->returnSuccessMessage('this doctor not found','done');
            }
            else {
//
                return $this->returnData('doctor', $doctor, 'done');
            }

        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }

//__________________________________________________________________________//

    public function create( DoctorRequest $request )
    {
        return "ok";
//        try {
//            $alldoctor = collect($request->doctor)->all();
//            DB::beginTransaction();
//            $unTransdoctor_id =doctor::insertGetId([
//                'image' => $request['image'],
//                'social_media_id' => $request['social_media_id'],
//                'appointments_id' => $request['appointments_id'],
//                'hospital_id' => $request['hospital_id'],
//                'clinic_id' => $request['clinic_id'],
//                'specialty_id' => $request['specialty_id'],
//                'is_approved' => $request['is_approved'],
//                'is_active' => $request['is_active'],
//            ]);
//            if (isset($alldoctor)) {
//                foreach ($alldoctor as $alldoctors) {
//                    $transdoctor[] = [
//                        'first_name' => $alldoctors ['first_name'],
//                        'last_name' => $alldoctors ['last_name'],
//                        'description' => $alldoctors ['description'],
//                        'locale' => $alldoctors['locale'],
//                        'doctor_id' => $unTransdoctor_id,
//                    ];
//                }
//                DoctorTranslation::insert( $transdoctor);
//            }
//            DB::commit();
//            return $this->returnData('doctor', [$unTransdoctor_id,  $transdoctor], 'done');
////        }
//        catch(\Exception $ex)
//        {
//            DB::rollback();
//            return $this->returnError('doctor', 'faild');
//        }
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
                    'appointments_id' => $request['appointments_id'],
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
                return $this->returnError('400','failed');
            }
    }

    public function trash( $id)
    {
        try{
         $doctor= $this->doctorModel::find($id);
        if(is_null($doctor)){
            return $this->returnSuccessMessage('This Appointment not found', 'done');}
        else{
        $doctor->is_active = false;
        $doctor->save();
        return $this->returnData('doctor', $doctor, 'This doctor is trashed Now');
    }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400','failed');
        }
    }

    public function getTrashed()
    {
        try {
            $doctor = $this->doctorModel::NotActive()->WithTrans()->all();
            return $this->returnData('doctor', $doctor, 'done');
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400','failed');
        }
    }

    public function restoreTrashed( $id)
    {
        try {
            $doctor = $this->doctorModel::find($id);
            if (is_null($doctor)) {
                return $this->returnSuccessMessage('This doctor not found', 'done');
            } else {
                $doctor->is_active = true;
                $doctor->save();
                return $this->returnData('doctor', $doctor, 'This doctor is trashed Now');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400','failed');
        }
    }

    public function delete($id)
    {
        try{
        $doctor = $this->doctorModel::find($id);
            if ($doctor->is_active == 0) {
                $doctor = $this->doctorModel->destroy($id);
            }
            return $this->returnData('doctor', $doctor, 'This doctor is deleted Now');

        } catch (\Exception $ex) {
            return $this->returnError('400', 'failed');
        }

    }

//    get all doctor's social media by doctor's name
    public function SocialMedia($doctor_name)
    {
        try {
            return doctor::with('socialMedia')->join('doctor_translation', 'doctor_translation.doctor_id', '=', 'doctor_id')
                ->where('doctor_translation.first_name', 'like', '%' . $doctor_name . '%')
                ->select('doctors.*', 'doctor_translation.first_name','doctor_translation.last_name')->get();
        }
        catch (\Exception $ex) {
            return $this->returnError('400', 'failed');
        }

    }


    //get  doctor's medical devices by doctor's name
    public function doctormedicaldevice($doctor_name)
    {
        try{
        return doctor::with('medicalDevice')
            ->join('doctor_translation','doctor_translation.doctor_id','=','doctor_id')
            ->where('doctor_translation.first_name','like','%'.$doctor_name.'%')
            ->select('doctors.*','doctor_translation.first_name','doctor_translation.last_name')->get();
        }
        catch (\Exception $ex) {
            return $this->returnError('400', 'failed');
        }
    }

    //get hospital by doctor's name
    public function hospital($doctor_name)
    {
      try{
         return doctor::with('hospital')->join('doctor_translation','doctor_translation.doctor_id','=','doctor_id')
            ->where('doctor_translation.first_name','like','%'.$doctor_name.'%')
            ->select('doctors.*','doctor_translation.first_name','doctor_translation.last_name')->get();
      }
      catch (\Exception $ex) {
           return $this->returnError('400', 'failed');
       }
    }

    //get doctor's appopintment
    public function appointment($doctor_name)
    {
        try{
        return doctor::with('appointment')
            ->join('doctor_translation','doctor_translation.doctor_id','=','doctor_id')
            ->where('doctor_translation.first_name','like','%'.$doctor_name.'%')
            ->select('doctors.*','doctor_translation.first_name','doctor_translation.last_name')->get();
        }
        catch (\Exception $ex) {
            return $this->returnError('400', 'failed');
        }
    }

    //get clinic by doctor's name
    public function clinic($doctor_name)
    {
        try{
        return doctor::with('clinic')->join('doctor_translation','doctor_translation.doctor_id','=','doctor_id')
            ->where('doctor_translation.first_name','like','%'.$doctor_name.'%')
            ->select('doctors.*','doctor_translation.first_name','doctor_translation.last_name')->get();
        }
        catch (\Exception $ex) {
            return $this->returnError('400', 'failed');
        }
    }

    //get all doctor's details by doctor's name
    public function getalldetails($doctor_name)
    {

        try{
        return  doctor::with('medicalDevice','socialMedia','clinic','hospital','Specialty')
            ->join('doctor_translation','doctor_translation.doctor_id','=','doctor_id')
            ->where('doctor_translation.first_name','like','%'.$doctor_name.'%')
//            ->where ( 'doctor_translation.locale','=', Config::get('app.locale'))
            ->select('doctors.*','doctor_translation.first_name','doctor_translation.last_name','doctor_translation.description')
            ->get();
        }
        catch (\Exception $ex) {
            return $this->returnError('400', 'failed');
        }
    }

    //get paitent by doctor's name
    public function customer($doctor_name)
    {
        try{
        return  doctor::with('customer')
             ->join('doctor_translation','doctor_translation.doctor_id','=','doctor_id')
             ->where('doctor_translation.first_name','like','%'.$doctor_name.'%')
             ->select('doctors.*','doctor_translation.first_name','doctor_translation.last_name')->get();
        }
        catch (\Exception $ex) {
            return $this->returnError('400', 'failed');
        }
    }

    //get doctor rate by doctor's name
    public function DoctorRate($doctor_name)
    {
        try{
      return doctor::with('DoctorRate')
          ->join('doctor_translation','doctor_translation.doctor_id','=','doctor_id')
          ->where('doctor_translation.first_name','like','%'.$doctor_name.'%')
          ->select('doctors.*','doctor_translation.first_name','doctor_translation.last_name')->get();
        }
        catch (\Exception $ex) {
            return $this->returnError('400', 'failed');
        }
    }
    //get specialty by doctor name
    public function DoctorSpecialty($doctor_name)
    {
        try {
            return doctor::with('Specialty')
                ->join('doctor_translation','doctor_translation.doctor_id','=','doctor_id')
                ->where('doctor_translation.first_name','like','%'.$doctor_name.'%')
                ->select('doctors.*','doctor_translation.first_name','doctor_translation.last_name')->get();
        } catch (\Exception $ex) {
            return $this->returnError('400', 'failed');
        }
    }




}
