<?php


namespace App\Service\MedicalDevice;

use App\Http\Requests\MedicalDevice\MedicalDeviceRequest;
use App\Models\Doctors\doctor;
use App\Models\Doctors\DoctorTranslation;
use App\Models\medicalDevice\medicalDevice;
use App\Models\medicalDevice\MedicalDeviceTranslation;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;


class MedicalDeviceService
{

    private $MedicalDeviceModel;
    use GeneralTrait;


    public function __construct(medicalDevice $MedicalDevice)
    {

        $this->MedicalDeviceModel=$MedicalDevice;
    }
    public function get()
    {

        $MedicalDevice=$this->MedicalDeviceModel::Active()->WithTrans()->get();
        return $this->returnData(' MedicalDevice', $MedicalDevice,'done');

    }

    public function getById($id)
    {

        $MedicalDevice= $this->MedicalDeviceModel::WithTrans()->find($id);
        return $this->returnData(' MedicalDevice', $MedicalDevice,'done');

    }

    public function getTrashed()
    {
        $MedicalDevice= $this->MedicalDeviceModel::all()->where('is_active',0);
        return $this -> returnData(' MedicalDevice', $MedicalDevice,'done');
    }
//________________________________________________________//
    public function create( MedicalDeviceRequest $request )
    {
        try {
            $allmedicaldevice = collect($request->medicaldevice)->all();
            DB::beginTransaction();
            $unTransmedicaldevice_id = medicalDevice::insertGetId([
                'doctor_id' => $request['doctor_id'],
                'hospital_id' => $request['hospital_id'],
                'is_approved' => $request['is_approved'],
                'is_active' => $request['is_active'],
            ]);
            if (isset($allmedicaldevice)) {
                foreach ($allmedicaldevice as $allmedicaldevices) {
                    $transmedicaldevice[] = [
                        'name' => $allmedicaldevices ['name'],
                        'locale' => $allmedicaldevices['locale'],
                        'medical_device_id' => $unTransmedicaldevice_id,
                    ];
                }
             MedicalDeviceTranslation::insert($transmedicaldevice);
            }
            DB::commit();
            return $this->returnData('MedicalDevice',[$unTransmedicaldevice_id, $transmedicaldevice],'done');
        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return $this->returnError('MedicalDevice', 'faild');
        }
    }
//__________________________________________________________________________//
    public function update(MedicalDeviceRequest $request,$id)
    {
        try{
            $medicaldevice= medicalDevice::find($id);
            if(!$medicaldevice)
                return $this->returnError('400', 'not found this medical Device');
            $allmedicaldevice = collect($request->medicaldevice)->all();
            if (!($request->has('medical_devices.is_active')))
                $request->request->add(['is_active'=>0]);
            else
                $request->request->add(['is_active'=>1]);

            $newmedicaldevice=medicalDevice::where('id',$id)
                ->update([
                    'doctor_id' => $request['doctor_id'],
                    'hospital_id' => $request['hospital_id'],
                    'is_approved' => $request['is_approved'],
                    'is_active' => $request['is_active'],
                ]);

            $ss=MedicalDeviceTranslation::where('medical_device_id',$id);
            $collection1 = collect($allmedicaldevice);
            $alldoctorlength=$collection1->count();
            $collection2 = collect($ss);

            $db_medicaldevice= array_values(MedicalDeviceTranslation::where('medical_device_id',$id)
                ->get()
                ->all());
            $dbmedicaldevice = array_values($db_medicaldevice);
            $request_medicaldevice= array_values($request->medicaldevice);
            foreach($dbmedicaldevice as $dbmedicaldevices){
                foreach($request_medicaldevice as $request_medicaldevices){
                    $values=MedicalDeviceTranslation::where('medical_Device_id',$id)
                        ->where('locale',$request_medicaldevices['locale'])
                        ->update([
                            'name' => $request_medicaldevices ['name'],
                            'locale' => $request_medicaldevices['locale'],
                            'medical_device_id' => $id,
                        ]);
                }
            }
            DB::commit();
            return $this->returnData('Medical Device', $dbmedicaldevice,'done');
        }
        catch(\Exception $ex){
            return $this->returnError('400', 'saving failed');
        }
    }
//______________________________________________________//
    public function search($name)
    {
        $MedicalDevice = DB::table('medical_devices')
            ->where("name","like","%".$name."%")
            ->get();
        if (! $MedicalDevice)
        {
            return $this->returnError('400', 'not found this medicalDevice');
        }
        else
        {
            return $this->returnData(' MedicalDevice',  $MedicalDevice,'done');

        }
    }

    public function trash( $id)
    {
        $MedicalDevice= $this->MedicalDeviceModel::find($id);
        $MedicalDevice->is_active=false;
        $MedicalDevice->save();

        return $this->returnData(' MedicalDevice',  $MedicalDevice,'This MedicalDevice is trashed Now');
    }


    public function restoreTrashed( $id)
    {
        $MedicalDevice=medicalDevice::find($id);
        $MedicalDevice->is_active=true;
        $MedicalDevice->save();

        return $this->returnData('MedicalDevice',  $MedicalDevice,'This MedicalDevice is trashed Now');
    }

    public function delete($id)
    {
        $MedicalDevice = medicalDevice::find($id);
        $MedicalDevice->is_active = false;
        $MedicalDevice->save();
        return $this->returnData('MedicalDevice',  $MedicalDevice, 'This MedicalDevice is deleted Now');

    }
}
