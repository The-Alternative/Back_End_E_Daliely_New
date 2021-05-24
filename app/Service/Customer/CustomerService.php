<?php


namespace App\Service\Customer;

use App\Models\Doctors\DoctorCustomer;
use Illuminate\Http\Request;
use App\Http\Requests\Customer\CustomerRequest;
use App\Models\Customer\CustomerTranslation;
use App\Models\Customer\Customer;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class CustomerService
{

    private $CustomerModel;
    use GeneralTrait;


    public function __construct(Customer $customer)
    {
        $this->CustomerModel=$customer;
    }
    public function get()
    {
        try
        {
        $customer= $this->CustomerModel::IsActive()->WithTrans()->get();
        return $this->returnData('customer',$customer,'done');
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400','failed');
        }
    }

    public function getById($id)
    {
        try{
            $customer= $this->CustomerModel::WithTrans()->find($id);
        if (is_null($customer)){
            return $this->returnSuccessMessage('this customer not found','done');
        }
        else{
            return  $this->returnData('customer',$customer,'done');
        }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400','failed');
        }
    }


//__________________________________________________________________________//

    public function create( CustomerRequest $request )
    {
        try {
//        $validated =validator::make($request->all());
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

            }

            DB::commit();
            return $this->returnData('Customer', [$unTranscustomer_id, $transcustomer], 'done');
        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return $this->returnError('Customer', 'failed');
        }
    }
//__________________________________________________________//
    public function update(CustomerRequest $request,$id)
    {
        try{
        $customer = Customer::find($id);
        if (!$customer)
            return $this->returnError('400', 'not found this customer');
        $allcustomer = collect($request->Customer)->all();
        if (!($request->has('customer.is_active')))
            $request->request->add(['is_active' => 0]);
        else
            $request->request->add(['is_active' => 1]);

        $newcustomer = Customer::where('id', $id)
            ->update([
                'social_media_id' => $request['social_media_id'],
                'is_approved' => $request['is_approved'],
                'is_active' => $request['is_active'],
            ]);

        $ss = CustomerTranslation::where('customer_id', $id);
        $collection1 = collect($allcustomer);
        $allcustomerlength = $collection1->count();
        $collection2 = collect($ss);

        $db_customer = array_values(CustomerTranslation::where('customer_id', $id)
            ->get()
            ->all());
        $dbcustomer = array_values($db_customer);
        $request_customer = array_values($request->customer);
        foreach ($dbcustomer as $dbcustomers) {
            foreach ($request_customer as $request_customers) {
                $values = CustomerTranslation::where('customer_id', $id)
                    ->where('locale', $request_customers['locale'])
                    ->update([
                        'first_name' => $request_customers ['first_name'],
                        'last_name' => $request_customers ['last_name'],
                        'address' => $request_customers ['address'],
                        'locale' => $request_customers['locale'],
                        'customer_id' => $id,
                    ]);
            }
        }
        DB::commit();
        return $this->returnData('customer', $dbcustomer, 'done');
    }
            catch(\Exception $ex)
        {
                  return $this->returnError('400', 'saving failed');
        }
    }
//___________________________________________________________//
    public function search($name)
    {
        try{
        $customer = DB::table('customers')
            ->where("first_name","like","%".$name."%")
            ->get();
        if (!$customer)
        {
            return $this->returnError('400', 'not found this customer');
        }
        else
        {
            return $this->returnData('customer', $customer,'done');
        }
        }
        catch(\Exception $ex){
            return $this->returnError('400','failed');
        }
    }

    public function trash( $id)
    {
        try {
        $customer= $this->CustomerModel::find($id);
            if (is_null($customer)) {
                return $this->returnSuccessMessage('This Customer not found', 'done');
            }
            else
            {
               $customer->is_active=false;
               $customer->save();
               return $this->returnData('customer', $customer,'This customer is trashed Now');
            }
        }
        catch (\Exception $ex)
        {
            return $this->returnError('400', 'failed');
        }
    }
    public function getTrashed()
    {
        try {
        $customer= $this->CustomerModel::NotActive()->get();
        return $this -> returnData('customer',$customer,'done');
        }
        catch (\Exception $ex)
        {
            return $this->returnError('400', 'failed');
        }
    }

    public function restoreTrashed( $id)
    {
        try {
            $customer=Customer::find($id);

            if (is_null($customer)) {
                return $this->returnSuccessMessage('This customer not found', 'done');
            }
            else
            {
                $customer->is_active=true;
                $customer->save();
                return $this->returnData('customer', $customer,'This customer is trashed Now');
            }
        }
        catch (\Exception $ex)
        {
            return $this->returnError('400', 'failed');
        }

    }

    public function delete($id)
    {
        try {
       $customer = Customer::find($id);
            if ($customer->is_active == 0) {
                $customer = $this->CustomerModel->destroy($id);
            }
            return $this->returnData('customer', $customer, 'This customer is deleted Now');
        } catch (\Exception $ex) {
            return $this->returnError('400', 'failed');
        }

    }


}
