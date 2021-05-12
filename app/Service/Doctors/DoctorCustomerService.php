<?php


namespace App\Service\Doctors;


use App\Http\Requests\Customer\CustomerRequest;
use App\Models\Customer\Customer;
use App\Models\Customer\CustomerTranslation;
use App\Models\Doctors\doctor;
use App\Models\Doctors\DoctorCustomer;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DoctorCustomerService
{
    private $doctorCustomerModel;
    private $customerModel;
    use GeneralTrait;


    public function __construct(DoctorCustomer $doctorcustomer,customer $customer)
    {
        $this->doctorCustomerModel=$doctorcustomer;
        $this->customerModel=$customer;
    }

        public function create(Request $request)
        {
            $doctor=[];
//            try {
            $allcustomer = collect($request->customer)->all();
            DB::beginTransaction();
            $unTranscustomer_id = Customer::insertGetId([
                'social_media_id' => $request['social_media_id'],
                'is_approved' => $request['is_approved'],
                'is_active' => $request['is_active'],
            ]);
            if (isset($allcustomer)) {
                foreach ($allcustomer as $allcustomers) {
                    $transcustomer[] = [
                        'first_name' => $allcustomers ['first_name'],
                        'last_name' => $allcustomers ['last_name'],
                        'address' => $allcustomers ['address'],
                        'locale' => $allcustomers['locale'],
                        'customer_id' => $unTranscustomer_id,
                    ];
                    CustomerTranslation::insert($transcustomer);
                }
                $doctor->customer()->syncWithoutDetaching([
                    'gender' => $request['gender'],
                    'note' => $request['note'],
                    'age' => $request['age'],
                    'social_status' => $request['social_status'],
                    'blood_type' => $request['blood_type'],
                    'customer_id' => $unTranscustomer_id,
                ]);
            }
                DoctorCustomer::insert($doctor);

                return $response = $this->returnData('insert customer by doctor', [$doctor], 'done');

            }
        }
//        if (isset($allcustomer)) {
//                foreach ($allcustomer as $allcustomers) {
//                    $transcustomer[] = [
//                        'first_name' => $allcustomers ['first_name'],
//                        'last_name' => $allcustomers ['last_name'],
//                        'address' => $allcustomers ['address'],
//                        'locale' => $allcustomers['locale'],
//                        'customer_id' => $unTranscustomer_id,
//                    ];
//                    CustomerTranslation::insert($transcustomer);
//                }
//            $doctor = collect($request->doctorcustomer)->all();
//                $doctor=DoctorCustomer::insert([
//                            'gender' => $request['gender'],
//                            'note' => $request['note'],
//                            'age' => $request['age'],
//                            'social_status' => $request['social_status'],
//                            'blood_type' => $request['blood_type'],
//                        ]);
//                        DoctorCustomer::insert($doctor);
//                return $doctor;
//
//                DB::commit();
//                return $this->returnData('Customer', [$unTranscustomer_id, $transcustomer], 'done');
//            }
//        }
//        catch(\Exception $ex)
//        {
//            DB::rollback();
//            return $this->returnError('Customer', 'faild');
//        }
//    }
//        $doctor=doctor::find($request->doctor_id);
//        if(!$doctor)
//            return "error";
//
//        $doctor->customer()->syncwithoutdetaching([
//                    'gender'              =>$request['gender'],
//                    'note'                =>$request['note'],
//                    'age'                 =>$request['age'],
//                    'social_status'       =>$request['social_status'],
//                    'blood_type'          =>$request['blood_type'],
//
//                ]);
//        DoctorCustomer::insert($doctor);
//
//      return response()->json();
//        customer::create(array(
//            'created_at'=>Carbon::now(),
//            'social_media_id'=>$request['social_media_id'],
//            'is_active'=>$request['is_active'],
//            'is_approved'=>$request['is_approved']
//        ));
////      $customer=customer::all()->last();
//        $countcustomer=customer::count();
//        $doctors=doctor::all();
//        foreach($doctors as $doctor)
//        {
//            $doctor_id[]=$doctor->id;
//        }
//        for($i=0;$i<$countcustomer;$i++)
//        {
//            $insertcustomer[$i]=$doctor->customer()->syncwithoutdetaching([
//                $doctor_id[$i]=>[
//                    ' first_name'         =>$request['first_name'],
//                    'last_name'          =>$request['last_name'],
//                    'gender'              =>$request['gender'],
//                    'note'                =>$request['note'],
//                    'age'                 =>$request['age'],
//                    'social_status'       =>$request['social_status'],
//                    'blood_type'          =>$request['blood_type'],
//
//                ]
//            ]);
//            DoctorCustomer::insert($insertcustomer[$i]);
//        }
//        return response()->json();
////         $doctor = doctor::find($request->doctor_id);
//        if (!$doctor)
//            return abort('404');
//        $customer->customer()->syncWithoutDetaching($request->customerId);
