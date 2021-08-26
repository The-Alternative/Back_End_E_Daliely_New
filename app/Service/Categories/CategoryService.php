<?php
namespace App\Service\Categories;

use App\Models\Categories\CategoryTranslation;
use App\Models\Categories\Category;
use App\Http\Requests\CategoryRequest;
use App\Traits\GeneralTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\File;

class CategoryService
{
    use GeneralTrait;
    private $categoryModel;
    private $categoryTranslation;
    /**
     * Category Service constructor.
     * @param Category $category
     * @param CategoryTranslation $categoryTranslation
     */
    public function __construct(Category $category , CategoryTranslation $categoryTranslation)
    {
        $this->categoryModel=$category;
        $this->categoryTranslation=$categoryTranslation;
    }
    /*___________________________________________________________________________*/
    /****Get All Active category Or By ID  ****/
    public function getAll()
    {
        try{
        $category = $this->categoryModel->with(['CategoryImages'=>function($q){
                return $q->where('is_cover',1)->get();}])->get();
            if (count($category) > 0){
                return $response= $this->returnData('Category',$category,'done');
            }else{
                return $response= $this->returnSuccessMessage('Category','Category doesnt exist yet');
            }
    }catch(\Exception $ex){
        return $this->returnError('400', $ex->getMessage());
        }
    }
    /*___________________________________________________________________________*/
    public function getById($id)
    {
        try{
        $category =$this->categoryModel->with(['CategoryImages','Category'])->find($id);
            if (is_null($category) ){
                return $response= $this->returnSuccessMessage('This Category not found','done');
            }else{
                return $response= $this->returnData('Category',$category,'done');
            }
        }catch(\Exception $ex){
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*___________________________________________________________________________*/
    public function getCategoryBySelf($id)
    {
        $category=$this->categoryModel->with('Category')->get();
        return $response= $this->returnData('Category',$category,'done');
    }
    /*___________________________________________________________________________*/
        /****ــــــThis Functions For Trashed category  ****/
    /****Get All Trashed category Or By ID  ****/
    public function getTrashed()
    {
        try{
        $category = $this->categoryModel->where('categories.is_active',0)->get();
          return $this -> returnData('Category',$category,'done');
        }catch(\Exception $ex){
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*___________________________________________________________________________*/
    /****Restore category Fore Active status  ***
     * @param $id
     * @return JsonResponse
     */
    public function restoreTrashed( $id)
    {
        try{
        $category=$this->categoryModel->find($id);
            if (is_null($category) ){
                return $response= $this->returnSuccessMessage('This Category not found','done');
            }else{
                $category->is_active=true;
                $category->save();
                return $this->returnData('Category', $category,'This Category Is trashed Now');
            }
        }catch(\Exception $ex){
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*___________________________________________________________________________*/
    /****   category's Soft Delete   ***
     * @param $id
     * @return JsonResponse
     */
    public function trash( $id)
    {
        try{
        $category=$this->categoryModel->find($id);
            $category=$this->categoryModel->find($id);
            if (is_null($category) ){
                return $response= $this->returnSuccessMessage('This Category not found','done');
            }else{
                $category->is_active=false;
                $category->save();
                return $this->returnData('Category', $category,'This Category Is trashed Now');
            }
        }catch(\Exception $ex){
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*___________________________________________________________________________*/
    /****  Create category   ***
     * @param CategoryRequest $request
     * @return JsonResponse
     */
    /*___________________________________________________________________________*/
    public function create(CategoryRequest $request)
    {
        try {
            $validated = $request->validated();
            $request->is_active ? $is_active = true : $is_active = false;
            $request->is_appear ? $is_appear = true : $is_appear = false;
            //transformation to collection
            $allcategories = collect($request->category)->all();
//            $filePath = "";
//            if ($request->has('image')) {
//
//                $filePath = $this->uploadImage('categories', $image);
//            }
            DB::beginTransaction();
            // //create the default language's product
            $unTransCategory_id = $this->categoryModel->insertGetId([
                'slug' => $request['slug'],
                'is_active' => $request['is_active'],
                'section_id' => $request['section_id'],
                'parent_id' => $request['parent_id']
            ]);
            //check the category and request
            if (isset($allcategories) && count($allcategories)) {
                //insert other traslations for products
                foreach ($allcategories as $allcategory) {
                    $transCategory_arr[] = [
                        'name' => $allcategory ['name'],
                        'local' => $allcategory['local'],
                        'category_id' => $unTransCategory_id,
                    ];
                }
                $this->categoryTranslation->insert($transCategory_arr);
            }
             $images = $request->images;
            foreach ($images as $image) {
                $arr[] = $image['image'];
            }

            foreach ($arr as $ar) {
                if (isset($image)) {
                    if ($request->hasFile($ar)) {

                        $folder = storage_path('/app/public/images/categories' . '/' . $unTransCategory_id . '/');
                        if (!File::exists($folder)) {
                            File::makeDirectory($folder, 0775, true, true);
                            $file_extension = $ar->getClientOriginalExtension();
                            $file_name = time() . $file_extension;
                            $path = 'images/categories';
                            $request->image->move($path, $file_name);
                        }
                    }
                }
                if ($request->has('images')) {
                    foreach ($images as $image) {
                        $categoryImages = $this->categoryModel->find($unTransCategory_id);
                        $categoryImages->CategoryImages()->insert([
                            'category_id' => $unTransCategory_id,
                            'image' =>  $image['image'],
                            'is_cover' => $image['is_cover']
                        ]);
                    }
                }
            }
                DB::commit();
                return $this->returnData('category', [$unTransCategory_id,$transCategory_arr],'done');
            }
            catch(\Exception $ex)
            {
                DB::rollback();
                return $this->returnError('category', $ex->getMessage());
            }
        }
    /*___________________________________________________________________________*/
    /****  Update category   ***
     * @param CategoryRequest $request
     * @param $id
     * @return Exception|JsonResponse
     */
    public function update(CategoryRequest $request,$id)
    {
        try{
            $validated = $request->validated();
            $category= $this->categoryModel->find($id);
            if(!$category)
                return $this->returnError('400', 'not found this Category');
           $allcategories = collect($request->category)->all();
            if (!($request->has('category.is_active')))
                $request->request->add(['is_active'=>0]);
            else
                $request->request->add(['is_active'=>1]);
           $ncategory=$this->categoryModel->where('categories.id',$id)
               ->update([
                   'slug'      =>$request['slug'],
                   'is_active' =>$request['is_active'],
                   'section_id' =>$request['section_id'],
                   'parent_id' =>$request['parent_id']
            ]);
            $ss=$this->categoryTranslation->where('category_translations.category_id',$id);
            $collection1 = collect($allcategories);
            $allcategorieslength=$collection1->count();
            $collection2 = collect($ss);

              $db_category= array_values(
                  $this->categoryTranslation
                  ->where('category_translations.category_id',$id)
                  ->get()
                  ->all());
              $dbdcategory = array_values($db_category);
              $request_category = array_values($request->category);
                foreach($dbdcategory as $dbdcategor){
                    foreach($request_category as $request_categor){
                        $values= $this->categoryTranslation->where('category_translations.category_id',$id)
                            ->where('local',$request_categor['local'])
                            ->update([
                            'name'=>$request_categor['name'],
                            'local'=>$request_categor['local'],
                            'category_id'=>$id
                        ]);
                    }
                }
            $images = $request->images;
            foreach ($images as $image) {
                $arr[] = $image['image'];
            }
            foreach ($arr as $ar) {
                if (isset($image)) {
                    if ($request->hasFile($ar)) {
                        //save
                        $file_extension = $ar->getClientOriginalExtension();
                        $file_name = time() . $file_extension;
                        $path = 'images/categories';
                        $ar->move($path, $file_name);
                    }
                }
            }
            if ($request->has('images')) {
                foreach ($images as $image) {
                    $categoryImages = $this->categoryModel->find($id);
                    $categoryImages->CategoryImages()->update([
                        'category_id' => $id,
                        'image' => $image['image'],
                        'is_cover' => $image['is_cover']
                    ]);
                }
            }
            DB::commit();
            return $this->returnData('Category', $dbdcategory,'done');
        }
        catch(\Exception $ex){
            DB::rollBack();
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*___________________________________________________________________________*/
    /****  ٍsearch for category   ***
     * @param $name
     * @return JsonResponse
     */
    public function search($name)
    {
        try {
            $category = DB::table('categories')
                ->where("name","like","%".$name."%")
                ->get();
            if (!$category)
            {
                return $this->returnError('400', 'not found this Category');
            }
            else
            {
                return $this->returnData('Category', $category,'done');
            }
        }catch(\Exception $ex){
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*___________________________________________________________________________*/
    /****  Delete category   ***
     * @param $id
     * @return JsonResponse
     */
    public function delete($id)
    {
        try{
        $category=$this->categoryModel->find($id);
        if ($category->is_active=0)
            {
                $category=$this->categoryModel->destroy($id);
                 return $this->returnData('Category', $category,'This Category Is deleted Now');
            }
        }catch(\Exception $ex){
            return $this->returnError('400', $ex->getMessage());
        }
    }
    function uploadImage($folder, $image)
    {
        $image->store('/', $folder);
        $filename = $image->hashName();
        $path = 'images/' . $folder . '/' . $filename;
        return $path;
    }

}
