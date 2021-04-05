<?php
namespace App\Service\Categories;

use App\Models\Categories\CategoryTranslation;
use App\Models\Custom_Fildes\Custom_Field;
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
<<<<<<< HEAD
        $this->categoryModel=$category;
=======
        $this->categoryModel=$category;s
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
        $this->categoryTranslation=$categoryTranslation;
    }

    /****Get All Active category Or By ID  ****/

    public function getAll()
    {
        try{
        $category = $this->categoryModel->get();
        return $response= $this->returnData('Category',$category,'done');
    }catch(\Exception $ex){
        return $this->returnError('400','faild');
        }
    }
    public function getById($id )
    {
        try{
        $category =$this->categoryModel->find($id);
        return $response= $this->returnData('Category',$category,'done');
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }
        /****ــــــThis Functions For Trashed category  ****/
    /****Get All Trashed Products Or By ID  ****/

    public function getTrashed()
    {
        try{
        $category = $this->categoryModel->where('is_active',0)->get();
          return $this -> returnData('Category',$category,'done');
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }
    /****Restore category Fore Active status  ****/

    public function restoreTrashed( $id)
    {
        try{
        $category=$this->categoryModel->find($id);
            $category->is_active=true;
            $category->save();
            return $this->returnData('Category', $category,'This Category Is trashed Now');
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }
        /****   category's Soft Delete   ****/

    public function trash( $id)
    {
        try{
        $category=$this->categoryModel->find($id);
            $category->is_active=false;
            $category->save();
            return $this->returnData('Category', $category,'This Category Is trashed Now');
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }

    /*ــــــــــــــــــــــــ  ـــــــــــــــــــــــ*/

    /****  Create category   ***
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    /*___________________________________________________________________________*/
        public function create(CategoryRequest $request)
        {
            try
            {
                $validated = $request->validated();
                $request->is_active?$is_active=true:$is_active=false;
                $request->is_appear?$is_appear=true:$is_appear=false;
                //transformation to collection
                $allcategories = collect($request->category)->all();
                ///select folder to save the image
                // $fileBath = "" ;
                //     if($request->has('image'))
                //     {
                //         $fileBath=uploadImage('images/products',$request->image);
                //     }
                DB::beginTransaction();
                // //create the default language's product
                $unTransCategory_id=$this->categoryModel->insertGetId([
                    'image' =>$request['image'],
<<<<<<< HEAD
                    'slug' => $request['slug'],
=======
                    'slug' => $allcategorie['slug'],
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
                    'lang_id' =>$request['lang_id'],
                    'is_active' =>$request['is_active'],
                    'parent_id'=>$request['parent_id']
                ]);
                //check the category and request
                if(isset($allcategories) && count($allcategories))
                {
                    //insert other traslations for products
                    foreach ($allcategories as $allcategorie)
                    {
                        $transCategory_arr[]=[
                            'name' => $allcategorie ['name'],
                            'local' => $allcategorie['local'],
                            'category_id' => $unTransCategory_id,
                            'language_id' => $allcategorie['language_id']
                        ];
                    }
                    $transCategory_arr;

                    $this->categoryTranslation->insert($transCategory_arr);
                }
                DB::commit();
                return $this->returnData('category', [$unTransCategory_id,$transCategory_arr],'done');
            }
            catch(\Exception $ex)
            {
                DB::rollback();
                return $this->returnError('category','faild');
            }
        }

    /*___________________________________________________________________________*/
    /****  Update category   ****/
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
            //save image
            // if($request->has('image')) {
            //     $filePath = uploadImage('products', $request->photo);
            //     Product::where('id', $pro_id)
            //         ->update([
            //             'image' => $filePath,
            //         ]);
            // }

           $ncategory=$this->categoryModel->where('id',$id)
               ->update([
                   'image'     =>$request['image'],
                   'slug'      =>$request['slug'],
                   'lang_id'   =>$request['lang_id'],
                   'is_active' =>$request['is_active'],
                   'parent_id' =>$request['parent_id']
            ]);
            $ss=$this->categoryTranslation->where('category_id',$id);
            $collection1 = collect($allcategories);
            $allcategorieslength=$collection1->count();
            $collection2 = collect($ss);

              $db_category= array_values(
                  $this->categoryTranslation
                  ->where('category_id',$id)
                  ->get()
                  ->all());
              $dbdcategory = array_values($db_category);
              $request_category = array_values($request->category);
                foreach($dbdcategory as $dbdcategor){
                    foreach($request_category as $request_categor){
                        $values= $this->categoryTranslation->where('category_id',$id)
                            ->where('locale',$request_categor['local'])
                            ->update([
                            'name'=>$request_categor['name'],
                            'local'=>$request_categor['local'],
                            'language_id'=>$request_categor['language_id'],
                            'category_id'=>$id
                        ]);
                    }
                }
            return $this->returnData('Category', $dbdcategory,'done');
            DB::commit();
        }
        catch(\Exception $ex){
            return $ex;
            return $this->returnError('400', 'saving failed');
        }
    }

    /*___________________________________________________________________________*/
                /****  ٍsearch for Product   ****/
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
            return $this->returnError('400','faild');
        }
    }

    /*___________________________________________________________________________*/
    /****  Delete Product   ****/
    public function delete($id)
    {
<<<<<<< HEAD

        $category=$this->Category::find($id);
        if ($category->is_active=0)

=======
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
        try{
        $category=$this->categoryModel->find($id);
        if ($category->$is_active=0)

            {
                $category=$this->categoryModel->destroy($id);
                 return $this->returnData('Category', $category,'This Category Is deleted Now');
            }
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }


}
