<?php
namespace App\Service\CustomFields;

use App\Models\Categories\CategoryTranslation;
use App\Models\Custom_Fieldes\Custom_Field;
use App\Models\Custom_Fieldes\Custom_Field_Translation;
use App\Models\Products\Product;
use App\Models\Categories\Category;
use App\Http\Requests\CategoryRequest;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\This;
use App\Exceptions\GeneralHandler;
use Exception;
use LaravelLocalization;

class CustomFieldService
{
    use GeneralTrait;
    private $CustomFieldModel;
    private $Custom_Field_Translation;
    /**
     * Category Service constructor.
     * @param Category $category
     * @param CategoryTranslation $categoryTranslation
     */
    public function __construct(Custom_Field $CustomFieldModel , Custom_Field_Translation $Custom_Field_Translation)
    {
        $this->CustomFieldModel=$CustomFieldModel;
        $this->Custom_Field_Translation=$Custom_Field_Translation;
    }
    /*___________________________________________________________________________*/
    /****Get All Active category Or By ID  ****/
    public function getAll()
    {
        try{
            $custom_field = $this->CustomFieldModel->get();
            if (count($custom_field) > 0){
                return $response= $this->returnData('Category',$custom_field,'done');
            }else{
                return $response= $this->returnSuccessMessage('custom_field','custom_field doesnt exist yet');
            }
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }
    /*___________________________________________________________________________*/
    public function getById($id)
    {
        try{
            $custom_field =$this->CustomFieldModel->find($id);
            if (is_null($custom_field) ){
                return $response= $this->returnSuccessMessage('This Category not found','done');
            }else{
                return $response= $this->returnData('Custom_field',$custom_field,'done');
            }
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }
    /*___________________________________________________________________________*/
    public function getCustomFieldsByProduct($id)
    {
        $custom_field=$this->CustomFieldModel->with('Product')->get();
        return $response= $this->returnData('Custom_field',$custom_field,'done');
    }
    /*___________________________________________________________________________*/
    /****ــــــThis Functions For Trashed category  ****/
    /****Get All Trashed Products Or By ID  ****/
    public function getTrashed()
    {
        try{
            $custom_field = $this->CustomFieldModel->where('is_active',0)->get();
            return $this -> returnData('Custom_field',$custom_field,'done');
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }
    /*___________________________________________________________________________*/
    /****Restore category Fore Active status  ***
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restoreTrashed( $id)
    {
        try{
            $custom_field=$this->CustomFieldModel->find($id);
            if (is_null($custom_field) ){
                return $response= $this->returnSuccessMessage('This Custom_field not found','done');
            }else{
                $custom_field->is_active=true;
                $custom_field->save();
                return $this->returnData('Custom_field', $custom_field,'This Custom_field Is trashed Now');
            }
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }
    /*___________________________________________________________________________*/
    /****   category's Soft Delete   ***
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function trash( $id)
    {
        try{
            $custom_field=$this->CustomFieldModel->find($id);
            if (is_null($custom_field) ){
                return $response= $this->returnSuccessMessage('This Custom_field not found','done');
            }else{
                $custom_field->is_active=false;
                $custom_field->save();
                return $this->returnData('Custom_field', $custom_field,'This Custom_field Is trashed Now');
            }
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }
    /*___________________________________________________________________________*/
    /****  Create category   ***
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    /*___________________________________________________________________________*/
    public function create(Request $request)
    {
//        try
//        {
            $validated = $request->validated();
            $request->is_active?$is_active=true:$is_active=false;
            //transformation to collection
            $allcustom_field = collect($request->custom_field)->all();
            ///select folder to save the image
            // $fileBath = "" ;
            //     if($request->has('image'))
            //     {
            //         $fileBath=uploadImage('images/products',$request->image);
            //     }
            DB::beginTransaction();
            // //create the default language's product
            $unTransCustomField_id=$this->CustomFieldModel->insertGetId([
                'image' =>$request['image'],
                'is_active' =>$request['is_active'],
            ]);
            //check the category and request
            if(isset($allCustomFieldes) && count($allCustomFieldes))
            {
                //insert other traslations for custom field
                foreach ($allCustomFieldes as $allCustomField)
                {
                    $transCustom_field_arr[]=[
                        'name' => $allCustomField ['name'],
                        'local' => $allCustomField['local'],
                        'description' => $allCustomField['description'],
                        'custom_field_id' => $unTransCustomField_id

                    ];
                }
                $this->Custom_Field_Translation->insert($transCustom_field_arr);
            }
            DB::commit();
            return $this->returnData('customField', [$unTransCustomField_id,$transCustom_field_arr],'done');
//        }
//        catch(\Exception $ex)
//        {
//            DB::rollback();
//            return $this->returnError('category','faild');
//        }
    }
    /*___________________________________________________________________________*/
    /****  Update category   ***
     * @param CategoryRequest $request
     * @param $id
     * @return Exception|\Illuminate\Http\JsonResponse
     */
    public function update(CategoryRequest $request,$id)
    {
//        try{
            $validated = $request->validated();
            $custom_field= $this->CustomFieldModel->find($id);
            if(!$custom_field)
                return $this->returnError('400', 'not found this custom_field');
            $allcustom_fields = collect($request->custom_field)->all();
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

            $ncustom_field=$this->CustomFieldModel->where('id',$id)
                ->update([
                    'image' =>$request['image'],
                    'is_active' =>$request['is_active']
                ]);
            $ss=$this->Custom_Field_Translation->where('category_id',$id);
            $collection1 = collect($allcustom_fields);
            $allcustom_fieldlength=$collection1->count();
            $collection2 = collect($ss);

            $db_custom_fields= array_values(
                $this->Custom_Field_Translation
                    ->where('category_id',$id)
                    ->get()
                    ->all());
            $dbdcustom_fields= array_values($db_custom_fields);
            $request_custom_fields = array_values($request->custom_field);
            foreach($db_custom_fields as $db_custom_field){
                foreach($request_custom_fields as $request_custom_field){
                    $values= $this->Custom_Field_Translation->where('category_id',$id)
                        ->where('locale',$request_custom_field['local'])
                        ->update([
                            'name' => $request_custom_field ['name'],
                            'local' => $request_custom_field['local'],
                            'custom_field_id' => $id,
                            'description' => $request_custom_field['description']
                        ]);
                }
            }
            DB::commit();
            return $this->returnData('custom_field', $dbdcustom_fields,'done');

//        }
//        catch(\Exception $ex){
//            DB::rollBack();
////            return $ex;
//            return $this->returnError('400', 'saving failed');
//        }
    }
    /*___________________________________________________________________________*/
    /****  ٍsearch for Product   ***
     * @param $name
     * @return \Illuminate\Http\JsonResponse
     */
    public function search($name)
    {
        try {
            $custom_field = DB::table('custom_fields')
                ->where("name","like","%".$name."%")
                ->get();
            if (!$custom_field)
            {
                return $this->returnError('400', 'not found this Custom_field');
            }
            else
            {
                return $this->returnData('Custom_field', $custom_field,'done');
            }
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }
    /*___________________________________________________________________________*/
    /****  Delete Product   ***
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try{
            $custom_field=$this->CustomFieldModel->find($id);
            if ($custom_field->is_active=0)
            {
                $custom_field=$this->CustomFieldModel->destroy($id);
                return $this->returnData('C$custom_fieldustom_field', $custom_field,'This C$custom_fieldustom_field Is deleted Now');
            }
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }
}
