<?php
namespace App\Service\Categories;

use App\Models\Categories\Category;
use App\Models\Categories\Section;
use App\Models\Categories\SectionTranslation;
use App\Traits\GeneralTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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
    /****Get All Active section Or By ID  ****/
    public function getAll()
    {
        try{
        $section = $this->SectionModel
            ->with(['Category','Product'])
            ->get();

            if (count($section) > 0) {
                return $this->returnData('Section', $section, 'done');
            } else {
                return $this->returnSuccessMessage('Section', 'Section doesnt exist yet');
            }
        }catch(\Exception $ex){
            return $this->returnError('400',$ex->getMessage());
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
                return $this->returnSuccessMessage('This Section not found','done');
            }else{
                return $this->returnData('Section',$section,'done');
            }
        }catch(\Exception $ex){
            return $this->returnError('400',$ex->getMessage());
        }
    }
    /*___________________________________________________________________________*/
    public function getCategoryBySection()
    {
        $sec=$this->SectionModel->with('Category')->get();
        if (is_null($sec) ){
            return $this->returnSuccessMessage('This section not found','done');
        }else{
            return $this->returnData('Section',$sec,'done');
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
                return $this->returnSuccessMessage('section','sections trashed doesnt exist yet');
            }
        }catch(\Exception $ex){
            return $this->returnError('400',$ex->getMessage());
        }
    }
    /*___________________________________________________________________________*/
    /****Restore section Fore Active status  ****/
    public function restoreTrashed( $id)
    {
        try{
        $section=$this->SectionModel->find($id);
            if (is_null($section) ){
                return $this->returnSuccessMessage('This Section not found','done');
            }else{
                $section->is_active=true;
                $section->save();
                return $this->returnData('Section', $section,'This Section Is trashed Now');
            }
        }catch(\Exception $ex){
            return $this->returnError('400',$ex->getMessage());
        }
    }
    /*___________________________________________________________________________*/
    /****   section's Soft Delete   ****/
    public function trash( $id)
    {
        try{
        $section=$this->SectionModel->find($id);
            if (is_null($section) ){
                return $this->returnSuccessMessage('This Section not found','done');
            }else{
                $section->is_active=false;
                $section->save();
                return $this->returnData('Section', $section,'This Section Is trashed Now');
            }
        }catch(\Exception $ex){
            return $this->returnError('400',$ex->getMessage());
        }
    }
    /*___________________________________________________________________________*/
    /****  Create Section   ***
     * @param Request $request
     * @return JsonResponse
     */
        public function create(Request $request)
        {
            try{
//                $validated = $request->validated();
//                $request->is_active?$is_active=true:$is_active=false;
                //transformation to collection
                $allsections = collect($request->section)->all();
                DB::beginTransaction();
                // //create the default language's product
                $unTransSection_id=$this->SectionModel->insertGetId([
                    'slug' => $request['slug'],
                    'image' => $request['image'],
                    'is_active' => $request['is_active']
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
                return $this->returnData('section', [$unTransSection_id,$transSection_arr],'done');
            }
            catch(\Exception $ex)
            {
                DB::rollback();
                return $this->returnError('Section',$ex->getMessage());
            }
        }
    /*___________________________________________________________________________*/
    /****  Update section   ***
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request,$id)
    {
        try{
            $section= $this->SectionModel->find($id);
            if(!$section)
                return $this->returnError('400', 'not found this section');
           $allsections= collect($request->section)->all();
            if (!($request->has('sections.is_active')))
                $request->request->add(['is_active'=>0]);
            else
                $request->request->add(['is_active'=>1]);
           $ncategory=$this->SectionModel->where('sections.id',$id)->update([
               'slug' => $request['slug'],
               'image' => $request['image'],
               'is_active' => $request['is_active'],
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
            return $this->returnData('Section', $dbdsections,'done');

        }
        catch(\Exception $ex){
            Db::rollBack();
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*___________________________________________________________________________*/
    /****  ٍsearch for section   ***
     * @param $name
     * @return JsonResponse
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
                return $this->returnData('section', $section,'done');
            }
        }catch(\Exception $ex){
            return $this->returnError('400',$ex->getMessage());
        }
    }
    /*___________________________________________________________________________*/
    /****  Delete section   ****/
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
            return $this->returnError('400',$ex->getMessage());
        }
    }
    /****  Upload Section's Image   ****/
    public function upload(Request $request)
    {
        $image = $request->file('image');
        $folder = public_path('images/sections' . '/');
        $filename = time() . '.' . $image->getClientOriginalName();
        $imageUrl='images/sections' . '/' . $filename;
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0775, true, true);
        }
        $image->move($folder,$filename);
        return $imageUrl;
    }
}
