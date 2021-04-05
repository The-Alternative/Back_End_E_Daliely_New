<?php


namespace App\Service\Customer;

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
        $customer= $this->CustomerModel::Active()->WithTrans();
        return $this->returnData('customer',$customer,'done');
    }

    public function getById($id)
    {
        $customer= $this->CustomerModel::WithTrans()->find($id);
        return $this->returnData('customer',$customer,'done');
    }

    public function getTrashed()
    {
        $customer= $this->CustomerModel::all()->where('is_active',0);
        return $this -> returnData('customer',$customer,'done');
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
                }
               CustomerTranslation::insert($transcustomer);
            }
            DB::commit();
            return $this->returnData('Customer', [$unTranscustomer_id, $transcustomer], 'done');
        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return $this->returnError('Customer', 'faild');
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

    public function trash( $id)
    {
        $customer= $this->CustomerModel::find($id);
        $customer->is_active=false;
        $customer->save();
        return $this->returnData('customer', $customer,'This customer is trashed Now');
    }

    public function restoreTrashed( $id)
    {
        $customer=Customer::find($id);
        $customer->is_active=true;
        $customer->save();
        return $this->returnData('customer', $customer,'This customer is trashed Now');
    }

    public function delete($id)
    {
       $customer = Customer::find($id);
       $customer->is_active = false;
       $customer->save();
        return $this->returnData('customer', $customer, 'This customer is deleted Now');
    }

}
