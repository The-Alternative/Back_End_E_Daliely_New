<?php


namespace App\Service\MenuType;


use App\Http\Requests\MenuType\MenuTypeRequest;
use App\Models\MenuType\MenuType;
use App\Models\MenuType\MenuTypeTranslation;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class MenuTypeService
{
    private $MenuTypeModel;
    use GeneralTrait;

    public function __construct(MenuType $MenuType)
    {
        $this->MenuTypeModel=$MenuType;
    }

    public function get()
    {
        try{
            $MenuType= $this->MenuTypeModel::paginate(5);
            return $this->returnData('Menu type',$MenuType,'done');
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
    public function getById($id)
    {
        try{
            $MenuType= $this->MenuTypeModel->find($id);
            if (is_null($MenuType)){
                return $this->returnSuccessMessage('this Menu Type not found','done');
            }
            else {
                return $this->returnData('Menu Type', $MenuType, 'done');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
//__________________________________________________________________________//
    public function create( MenuTypeRequest $request )
    {
        try {
            $allmenutype = collect($request->MenuType)->all();
            DB::beginTransaction();
            $unTransMenuType_id =MenuType::insertGetId([
                'image' => $request['image'],
                'is_approved' => $request['is_approved'],
                'is_active' => $request['is_active'],
                'menu_id' => $request['menu_id'],
            ]);
            if (isset($allmenutype)) {
                foreach ($allmenutype as $allmenutypes) {
                    $transmenuType[] = [
                        'title' => $allmenutypes ['title'],
                        'short_description' => $allmenutypes ['short_description'],
                        'long_description' => $allmenutypes ['short_description'],
                        'locale' => $allmenutypes['locale'],
                        'menu_type_id' => $unTransMenuType_id,
                    ];
                }
                MenuTypeTranslation::insert( $transmenuType);
            }
            DB::commit();
            return $this->returnData('Menu Type', [$unTransMenuType_id,$transmenuType], 'done');
        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return $this->returnError('Menu Type', $ex->getMessage());
        }
    }
//_________________________________________________________//
    public function update(MenuTypeRequest $request,$id)
    {
        try{
            $MenuType= MenuType::find($id);
            if(!$MenuType)
                return $this->returnError('400', 'not found this Menu Type');
            $allmenuType = collect($request->MenuType)->all();
            if (!($request->has('menu_types.is_active')))
                $request->request->add(['is_active'=>0]);
            else
                $request->request->add(['is_active'=>1]);

            $newmenuType=MenuType::where('menu_types.id',$id)
                ->update([
                    'image' => $request['image'],
                    'is_approved' => $request['is_approved'],
                    'is_active' => $request['is_active'],
                    'menu_id' => $request['menu_id'],

                ]);

            $ss=MenuTypeTranslation::where('menu_type_translations.menu_type_id',$id);
            $collection1 = collect($allmenuType);
            $allmenuTypelength=$collection1->count();
            $collection2 = collect($ss);

            $db_menuType=array_values(MenuTypeTranslation::where('menu_type_translations.menu_type_id',$id)
                ->get()
                ->all());
            $dbmenuType = array_values($db_menuType);
            $request_menuType= array_values($request->MenuType);
            foreach($dbmenuType as $dbmenuTypes){
                foreach($request_menuType as $request_menuTypes){
                    $values= MenuTypeTranslation::where('menu_type_translations.menu_type_id',$id)
                        ->where('locale',$request_menuTypes['locale'])
                        ->update([
                            'title' => $request_menuTypes ['title'],
                            'short_description' => $request_menuTypes ['short_description'],
                            'long_description' => $request_menuTypes ['short_description'],
                            'locale' => $request_menuTypes['locale'],
                            'menu_type_id' => $id,
                        ]);
                }
            }
            DB::commit();
            return $this->returnData('Menu Type', [$dbmenuType,$values],'done');
        }
        catch(\Exception $ex){
            return $this->returnError('400', $ex->getMessage());
        }
    }
//___________________________________________________________//
    public function search($meal_type_title)
    {
        try {
            $MenuType = DB::table('menu_type_translations')
                ->where("title", "like", "%" . $meal_type_title . "%")
                ->get();
            if (!$MenuType) {
                return $this->returnError('400', 'not found this Menu Type');
            } else {
                return $this->returnData('Menu Type', $MenuType, 'done');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
    public function trash( $id)
    {
        try{
            $MenuType= $this->MenuTypeModel::find($id);
            if(is_null($MenuType)){
                return $this->returnSuccessMessage('This Menu Type not found', 'done');}
            else{
                $MenuType->is_active =0;
                $MenuType->save();
                return $this->returnData('Menu Type', $MenuType, 'This Menu Type is trashed Now');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
    public function getTrashed()
    {
        try {
            $MenuType = $this->MenuTypeModel::NotActive();
            return $this->returnData('Menu Type', $MenuType, 'done');
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
    public function restoreTrashed( $id)
    {
        try {
            $MenuType = $this->MenuTypeModel::find($id);
            if (is_null($MenuType)) {
                return $this->returnSuccessMessage('This Menu Type not found', 'done');
            } else {
                $MenuType->is_active =1;
                $MenuType->save();
                return $this->returnData('Menu Type', $MenuType, 'This Menu Type is trashed Now');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
    public function delete($id)
    {
        try{
            $MenuType = $this->MenuTypeModel::find($id);
            if ($MenuType->is_active == 0) {
                $MenuType ->delete();
                $MenuType ->MenuTypeTranslation()->delete();
                return $this->returnData('Menu Type', $MenuType, 'This Menu Type is deleted Now');

            }
            else {
                return $this->returnData('Menu Type', $MenuType, 'This Menu Type can not deleted Now');
            }
        } catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }

    }
}
