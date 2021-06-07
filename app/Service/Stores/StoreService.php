<?php
namespace App\Service\Stores;
use App\Http\Requests\Store\StoreRequest;
use App\Http\Requests\StoreProduct\StoreProductRequest;
use App\Models\Stores\Store;
use App\Models\Stores\StoreTranslation;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LaravelLocalization;
class  StoreService
{
    use GeneralTrait;
    private $StoreService;
    private $storeModel;
    private $storeTranslation;
    private $Store;

    public function __construct(Store $store ,StoreTranslation $storeTranslation)
    {
        $this->storeModel=$store;
        $this->storeTranslation=$storeTranslation;
    }
    /****Get All Active category Or By ID  ****/
    public function getAll()
    {
        try {
            $store =collect($this->storeModel->with(['Section','Product','Brand'])->get());
            if (count($store) > 0){
                return $this->returnData('Stores',$store,'done');
            }else{
                return $response= $this->returnSuccessMessage('Store','stores doesnt exist yet');
            }
        } catch(\Exception $ex){

            return $this->returnError('400','faild');
        }
    }
    /*___________________________________________________________________________*/
    public function getById($store_id)
    {
//        try {
        $store =  $this->storeModel->with(['Product'=>function($q) use ($store_id) {
            return $q->with(['Category'=>function($q){
                return $q->with('Section')->get();
            },'StoreProduct'=>function($q) use ($store_id) {
                return $q->where('store_id',$store_id)->get();
            }])->get();
        },'Section'=>function($q){
            return $q->with('Category')->get();
        },'Brand','StoreImage'])->find($store_id);
            if (is_null($store) ){
                return $response= $this->returnSuccessMessage('Store','This stores not found');
            }else{
                return $this->returnData('Store',$store,'done');
            }
//        }catch(\Exception $ex){
//            return $this->returnError('400','faild');
//        }
    }
    /*___________________________________________________________________________*/
    /****  This Functions For Trashed category  ****/
    /****  Get All Trashed Products Or By ID  ****/
    public function getTrashed()
    {
        try {
        $store = $this->storeModel->where('is_active',0)->get();
            if (count($store) > 0){
                return $response= $this->returnData('Store',$store,'done');
            }else{
                return $response= $this->returnSuccessMessage('Store','stores doesnt exist yet');
            }
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }
    /*___________________________________________________________________________*/
    /****Restore category Fore Active status  ****/
    public function restoreTrashed( $id)
    {
        try{
            $store=$this->storeModel->find($id);
            if (is_null($store) ){
                return $response= $this->returnSuccessMessage('Store','This stores not found');
            }else{
                $store->is_active=true;
                $store->save();
                return $this->returnData('Store', $store,'This Store Is trashed Now');
            }
            }catch(\Exception $ex){
        return $this->returnError('400','faild');
        }
    }
    /*___________________________________________________________________________*/
    /****   category's Soft Delete   ****/
    public function trash( $id)
    {
        try{
            $store=$this->storeModel->find($id);
            if (is_null($store) ){
                return $response= $this->returnSuccessMessage('Store','This stores not found');
            }else{
                $store->is_active=false;
                $store->save();
                return $this->returnData('Store', $store,'This Store Is trashed Now');
            }
        }catch(\Exception $ex){
              return $this->returnError('400','faild');
        }
    }
    /*ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ*/
    /****  Create category   ****/
    /*___________________________________________________________________________*/
    public function create(Request $request)
    {
        try {
//        validated = $request->validated();
        $request->is_active?$is_active=true:$is_active=false;
        $request->is_appear?$is_appear=true:$is_appear=false;
        //transformation to collection
        $stores = collect($request->store)->all();
        ///select folder to save the image
        // $fileBath = "" ;
        //     if($request->has('image'))
        //     {
        //         $fileBath=uploadImage('images/products',$request->image);
        //     }
        DB::beginTransaction();
        // //create the default language's product
        $unTransStore_id=$this->storeModel->insertGetId([
            //                'section_id' =>$request['section_id'],
            'loc_id' =>$request['loc_id'],
            'country_id' =>$request['country_id'],
            'gov_id' =>$request['gov_id'],
            'city_id'=>$request['city_id'],
            'street_id'=>$request['street_id'],
            'offer_id'=>$request['offer_id'],
            'socialMedia_id'=>$request['socialMedia_id'],
            'followers_id'=>$request['followers_id'],
            'is_active'=>$request['is_active'],
            'is_approved'=>$request['is_approved'],
            'delivery'=>$request['delivery'],
            'edalilyPoint'=>$request['edalilyPoint'],
            'rating'=>$request['rating'],
            'workingHours'=>$request['workingHours'],
            'logo'=>$request['logo']
        ]);
        //check the category and request
        if(isset($stores) && count($stores))
        {
            //insert other traslations for products
            foreach ($stores as $store)
            {
                $transstore_arr[]=[
                    'local'=>$store['local'],
                    'title' =>$store['title'],
                    'store_id'=>$unTransStore_id
                ];
            }
            $this->storeTranslation->insert($transstore_arr);
        }
        DB::commit();
        return $this->returnData('Store', [$unTransStore_id,$transstore_arr],'done');
        }
        catch(\Exception $ex)
            {
                DB::rollback();
                return $this->returnError('store',$ex->getMessage());
            }
    }
    /*___________________________________________________________________________*/
    /****__________________  Update category   ___________________****/
    public function update(Request $request,$id)
    {
        try{
            //$validated = $request->validated();
            $store= $this->storeModel->find($id);
            if(!$store)
                return $this->returnError('400', 'not found this Store');
            if (!($request->has('category.is_active')))
                $request->request->add(['is_active'=>0]);
            else
                $request->request->add(['is_active'=>1]);
            //save image
            // if($request->has('image')) {
            //     $filePath = uploadImage('products', $request->photo);
            //     Product::where('id', $pro_id)
            //         ->update([
            //             'image' => $filePath,
            //         ]);
            // }
            DB::beginTransaction();
            $nStore=$this->storeModel->where('stores.id',$id)
                ->update([
                    'loc_id' => $request['loc_id'],
                    'country_id' => $request['country_id'],
                    'gov_id' => $request['gov_id'],
                    'city_id'=>$request['city_id'],
                    'street_id'=>$request['street_id'],
                    'offer_id'=>$request['offer_id'],
                    'socialMedia_id'=>$request['socialMedia_id'],
                    'followers_id'=>$request['followers_id'],
                    'is_active'=>$request['is_active'],
                    'is_approved'=>$request['is_approved'],
                    'delivery'=>$request['delivery'],
                    'edalilyPoint'=>$request['edalilyPoint'],
                    'rating'=>$request['rating'],
                    'workingHours'=>$request['workingHours'],
                    'logo'=>$request['logo'],
                ]);
        $stores = collect($request->store)->all();
        //Stores in database
            $dbdstores=$this->storeModel->where('Store_id',$id)->get();
            foreach($dbdstores as $dbdstore){
                foreach($stores as $store){
                    $values= StoreTranslation::where('store_id',$id)
                        ->where('local',$store['local'])
                        ->update([
                            'title'=>$store['title'],
                            'local'=>$store['local'],
                            'store_id'=>$id
                        ]);
                }
            }
            DB::commit();
            return $this->returnData('Store', [$id,$dbdstores,$nStore],'Updated Done');
        }
        catch(\Exception $ex){
            DB::rollback();
            return $this->returnError('400', 'Updating failed');
        }
    }
    /*___________________________________________________________________________*/
    /****________________  ٍsearch for Product _________________****/
    public function search($title)
    {
        try{
        $store = DB::table('Store')
            ->where("name","like","%".$title."%")
            ->get();
        if (!$store)
        {
            return $this->returnError('400', 'not found this Store');
        }
        else
        {
            return $this->returnData('Store', $store,'done');
        }
            }catch(\Exception $ex){
        return $this->returnError('400','faild');
        }
    }
    /*___________________________________________________________________________*/
    /****_______________  Delete Product   ________________****/
    public function delete($id)
    {
        try
        {
         $store =$this->storeModel->find($id);
        if ($store->is_active==0)
        {
            $store=Store::destroy($id);

        }
        return $this->returnData('Category', $store,'This Store Is deleted Now');
         }catch(\Exception $ex){
           return $this->returnError('400','faild');
        }
    }
    public function getSectionInStore($id)
    {
        try {
            $store =$this->storeModel->with('Section')->find($id);
            if (is_null($store) ){
                return $response= $this->returnSuccessMessage('Store','This stores not found');
            }else {
                return $this->returnData('Category', $store, 'This Store Is deleted Now');
            }
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }
}
