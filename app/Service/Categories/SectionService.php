<?php
namespace App\Service\Categories;

use App\Models\Categories\Category;
use App\Models\Categories\Section;
use App\Models\Categories\SectionTranslation;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use LaravelLocalization;

class SectionService
{
    use GeneralTrait;
    private $SectionService;
    private $SectionModel;
    private $SectionTranslation;
    private $categoryModel;



    public function __construct(Section $sectionModel,SectionTranslation $sectionTranslation,Category $categoryModel)
    {
        $this->SectionModel=$sectionModel;
        $this->categoryModel=$categoryModel;
        $this->SectionTranslation=$sectionTranslation;
    }
    /*___________________________________________________________________________*/
    /****Get All Active category Or By ID  ****/
    public function getAll()
    {
        try{
        $section = $this->SectionModel
            ->with(['Category','Product'])
            ->get();

            if (count($section) > 0) {
                return $response = $this->returnData('Section', $section, 'done');
            } else {
                return $response = $this->returnSuccessMessage('Section', 'Section doesnt exist yet');
            }
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
        }
    /*___________________________________________________________________________*/
    public function getById($id )
    {
        try{
         $section = $this->SectionModel
            ->with(['Category'=>function($q){
                return $q->with(['Product'=>function($q){
                    return $q->with(['StoreProduct'])->get();
                }])->get();
            }])
            ->find($id);
            if (is_null($section) ){
                return $response= $this->returnSuccessMessage('This Section not found','done');
            }else{
                return $response= $this->returnData('Section',$section,'done');
            }
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }
    /*___________________________________________________________________________*/
    public function getCategoryBySection()
    {
        $category=$this->SectionModel->with('Category')->get();
        if (is_null($category) ){
            return $response= $this->returnSuccessMessage('This category not found','done');
        }else{
            return $response= $this->returnData('category',$category,'done');
        }
    }
    /*___________________________________________________________________________*/
    /****ــــــThis Functions For Trashed Sections  ****/
    /****Get All Trashed Sections Or By ID  ****/
    public function getTrashed()
    {
        try{
        $section = $this->SectionModel->where('is_active',0)->get();
            if (count($section) > 0){
                return $this -> returnData('Section',$section,'done');
            }else{
                return $response= $this->returnSuccessMessage('Product','Products trashed doesnt exist yet');
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
        $section=$this->SectionModel->find($id);
            if (is_null($section) ){
                return $response= $this->returnSuccessMessage('This Section not found','done');
            }else{
                $section->is_active=true;
                $section->save();
                return $this->returnData('Section', $section,'This Section Is trashed Now');
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
        $section=$this->SectionModel->find($id);
            if (is_null($section) ){
                return $response= $this->returnSuccessMessage('This Section not found','done');
            }else{
                $section->is_active=false;
                $section->save();
                return $this->returnData('Section', $section,'This Section Is trashed Now');
            }
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }
    /*___________________________________________________________________________*/
    /****  Create Section   ***
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
        public function create(Request $request)
        {
            try{
//                $validated = $request->validated();
                $request->is_active?$is_active=true:$is_active=false;
//                $request->is_appear?$is_appear=true:$is_appear=false;
                //transformation to collection
                $allsections = collect($request->section)->all();
                ///select folder to save the image
                // $fileBath = "" ;
                //     if($request->has('image'))
                //     {
                //         $fileBath=uploadImage('images/products',$request->image);
                //     }
                DB::beginTransaction();
                // //create the default language's product
                $unTransSection_id=$this->SectionModel->insertGetId([

                    'slug' => $request['slug'],
                    'image' => $request['image'],
                    'is_active' => $request['is_active'],
//                    'categories_id' => $request['categories_id']
                ]);
                //check the category and request
                if(isset($allsections) && count($allsections))
                {
                    //insert other traslations for sections
                    foreach ($allsections as $allsection)
                    {
                        $transSection_arr[]=[
                            'name' => $allsection['name'],
                            'description' =>$allsection['description'],
                            'local' => $allsection['local'],
                            'section_id' => $unTransSection_id
                        ];
                    }
                    $this->SectionTranslation->insert($transSection_arr);
                }
                DB::commit();
                return $this->returnData('category', [$unTransSection_id,$transSection_arr],'done');
            }
            catch(\Exception $ex)
            {
                DB::rollback();
                return $this->returnError('category','faild');
            }
        }
    /*___________________________________________________________________________*/
    /****  Update category   ***
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,$id)
    {
//        $validated = $request->validated();
        try{
            $section= $this->SectionModel->find($id);
            if(!$section)
                return $this->returnError('400', 'not found this Category');
           $allsections= collect($request->section)->all();
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

           $ncategory=$this->SectionModel->where('id',$id)->update([
               'slug' => $request['slug'],
               'image' => $request['image'],
               'is_active' => $request['is_active'],
               'categories_id' => $request['categories_id']
            ]);
            $ss=$this->SectionTranslation->where('section_id',$id);
            $collection1 = collect($allsections);
            $allsectionslength=$collection1->count();
            $collection2 = collect($ss);

              $db_section= array_values($this->SectionTranslation->where('section_id',$id)->get()->all());
              $dbdsections = array_values($db_section);
              $request_sections = array_values($request->section);
                foreach($dbdsections as $dbdsection){
                    foreach($request_sections as $request_section){
                        $values= $this->SectionTranslation
                            ->where('section_id',$id)
                            ->where('local',$request_section['local'])
                            ->update([
                            'name' => $request_section['name'],
                            'description' =>$request_section['description'],
                            'local' => $request_section['local'],
                            'section_id' => $id
                        ]);
                    }
                }
            DB::commit();
            return $this->returnData('Category', $dbdsections,'done');

        }
        catch(\Exception $ex){
            Db::rollBack();
            return $this->returnError('400', 'saving failed');
        }
    }
    /*___________________________________________________________________________*/
    /****  ٍsearch for Product   ***
     * @param $name
     * @return \Illuminate\Http\JsonResponse
     */
    public function search($name)
    {
        try{
        $section = DB::table('sections')
                ->where("name","like","%".$name."%")
                ->get();
        if (!$section)
        {
            return $this->returnError('400', 'not found this Section');
        }
          else
            {
                return $this->returnData('Category', $section,'done');
            }
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }
    /*___________________________________________________________________________*/
    /****  Delete Product   ****/
    public function delete($id)
    {
        try{
        $section=$this->SectionModel->find($id);
        if ($section->is_active=0)
            {
                $section=$this->SectionModel->destroy($id);
                 return $this->returnData('Section', $section,'This Section Is deleted Now');
            }
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }
}
