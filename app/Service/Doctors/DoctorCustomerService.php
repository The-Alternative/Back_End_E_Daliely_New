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


    public function __construct(DoctorCustomer $doctorcustomer,customer $customer,doctor $doctor)
    {
        $this->doctorCustomerModel=$doctorcustomer;
        $this->customerModel=$customer;
        $this->doctorModel=$doctor;
    }

        public function create(Request $request)
        {

            try {
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
                }
                CustomerTranslation::insert($transcustomer);
            }

            if ($request->has('cus')) {
                $doctor = $this->customerModel->find($unTranscustomer_id);
                $doctor->doctor()->sync($request->get('cus'));

            }
            DB::commit();
            return $this->returnData('insert customer by doctor', [$doctor], 'done');
        }
           catch(\Exception $ex)
           {
           DB::rollback();
           return $this->returnError('400',$ex->getMessage());
           }
      }
}

