<?php


namespace App\Service\MealType;


use App\Http\Requests\MealType\MealTypeRequest;
use App\Models\MealType\MealType;
use App\Models\MealType\MealTypeTranslation;
use App\Models\MenuType\MenuTypeTranslation;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class MealTypeService
{
    private $MealTypeModel;
    use GeneralTrait;

    public function __construct(MealType $MealType)
    {
        $this->MealTypeModel=$MealType;
    }
    public function get()
    {
        try{
            $MealType= $this->MealTypeModel::paginate(5);
            return $this->returnData('Meal Type ',$MealType,'done');
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
    public function getById($id)
    {
        try{
            $MealType= $this->MealTypeModel->find($id);
            if (is_null($MealType)){
                return $this->returnSuccessMessage('this Meal Type not found','done');
            }
            else {
                return $this->returnData('Meal Type', $MealType, 'done');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
//__________________________________________________________________________//
    public function create( MealTypeRequest $request )
    {
        try {
            $allmealtype = collect($request->MealType)->all();
            DB::beginTransaction();
            $unTransMealType_id =MealType::insertGetId([
                'image' => $request['image'],
                'is_approved' => $request['is_approved'],
                'is_active' => $request['is_active'],
            ]);
            if (isset($allmealtype)) {
                foreach ($allmealtype as $allmealtypes) {
                    $transmealType[] = [
                        'title' => $allmealtypes ['title'],
                        'short_description' => $allmealtypes ['short_description'],
                        'long_description' => $allmealtypes ['short_description'],
                        'locale' => $allmealtypes['locale'],
                        'meal_id' => $unTransMealType_id,
                    ];
                }
                MealTypeTranslation::insert( $transmealType);
            }
            DB::commit();
            return $this->returnData('Meal Type', [$unTransMealType_id,$transmealType], 'done');
        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return $this->returnError('Meal Type', $ex->getMessage());
        }
    }
//_________________________________________________________//
    public function update(MealTypeRequest $request,$id)
    {
        try{
            $MealType= MealType::find($id);
            if(!$MealType)
                return $this->returnError('400', 'not found this Meal Type');
            $allmealType = collect($request->MealType)->all();
            if (!($request->has('meal_types.is_active')))
                $request->request->add(['is_active'=>0]);
            else
                $request->request->add(['is_active'=>1]);

            $newmealType=MealType::where('meal_types.id',$id)
                ->update([
                    'image' => $request['image'],
                    'is_approved' => $request['is_approved'],
                    'is_active' => $request['is_active'],
                ]);

            $ss=MealTypeTranslation::where('meal_type_translations.meal_type_id',$id);
            $collection1 = collect($allmealType);
            $allmealTypelength=$collection1->count();
            $collection2 = collect($ss);

            $db_mealType= array_values(MealTypeTranslation::where('meal_type_translations.meal_type_id',$id)
                ->get()
                ->all());
            $dbmealType = array_values($db_mealType);
            $request_mealType= array_values($request->Meal);
            foreach($dbmealType as $dbmealTypes){
                foreach($request_mealType as $request_mealTypes){
                    $values= MenuTypeTranslation::where('menu_type_translations.menu_type_id',$id)
                        ->where('locale',$request_mealTypes['locale'])
                        ->update([
                            'title' => $request_mealTypes ['title'],
                            'short_description' => $request_mealTypes ['short_description'],
                            'long_description' => $request_mealTypes ['short_description'],
                            'locale' => $request_mealTypes['locale'],
                            'meal_type_id' => $id,
                        ]);
                }
            }
            DB::commit();
            return $this->returnData('Meal Type', [$dbmealType,$values],'done');
        }
        catch(\Exception $ex){
            return $this->returnError('400', $ex->getMessage());
        }
    }
//___________________________________________________________//
    public function search($meal_name)
    {
        try {
            $MealType = DB::table('meal_translations')
                ->where("title", "like", "%" . $meal_name . "%")
                ->get();
            if (!$MealType) {
                return $this->returnError('400', 'not found this Meal Type');
            } else {
                return $this->returnData('Meal Type', $MealType, 'done');
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
            $MealType= $this->MealTypeModel::find($id);
            if(is_null($MealType)){
                return $this->returnSuccessMessage('This Meal Type not found', 'done');}
            else{
                $MealType->is_active =0;
                $MealType->save();
                return $this->returnData('Meal Type', $MealType, 'This Meal Type is trashed Now');
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
            $MealType = $this->MealTypeModel::NotActive();
            return $this->returnData('Meal Type', $MealType, 'done');
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
    public function restoreTrashed( $id)
    {
        try {
            $MealType = $this->MealTypeModel::find($id);
            if (is_null($MealType)) {
                return $this->returnSuccessMessage('This Meal Type not found', 'done');
            } else {
                $MealType->is_active =1;
                $MealType->save();
                return $this->returnData('Meal Type', $MealType, 'This Meal Type is trashed Now');
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
            $MealType = $this->MealTypeModel::find($id);
            if ($MealType->is_active == 0) {
                $MealType ->delete();
                $MealType ->MenuTypeTranslation()->delete();
                return $this->returnData('Meal Type', $MealType, 'This Meal Type is deleted Now');

            }
            else {
                return $this->returnData('Meal Type', $MealType, 'This Meal Type can not deleted Now');
            }
        } catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }

    }
}
