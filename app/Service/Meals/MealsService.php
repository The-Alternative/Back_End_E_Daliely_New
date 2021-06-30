<?php


namespace App\Service\Meals;


use App\Http\Requests\Meals\MealsRequest;
use App\Models\Meals\Meal;
use App\Models\Meals\MealTranslation;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class MealsService
{
    private $MealModel;
    use GeneralTrait;

    public function __construct(Meal $Meal)
    {
        $this->MealModel=$Meal;
    }
    public function get()
    {
        try{
            $Meal= $this->MealModel::paginate(5);
            return $this->returnData('Meal ',$Meal,'done');
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
    public function getById($id)
    {
        try{
            $Meal= $this->MealModel->find($id);
            if (is_null($Meal)){
                return $this->returnSuccessMessage('this Meal not found','done');
            }
            else {
                return $this->returnData('Meal', $Meal, 'done');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
//__________________________________________________________________________//
    public function create( MealsRequest $request )
    {
        try {
            $allMeal = collect($request->Meal)->all();
            DB::beginTransaction();
            $unTransMeal_id =Meal::insertGetId([
                'image' => $request['image'],
                'meal_type_id' => $request['meal_type_id'],
                'is_approved' => $request['is_approved'],
                'is_active' => $request['is_active'],
            ]);
            if (isset($allMeal)) {
                foreach ($allMeal as $allMeals) {
                    $transmeal[] = [
                        'title' => $allMeals ['title'],
                        'short_description' => $allMeals ['short_description'],
                        'long_description' => $allMeals ['short_description'],
                        'locale' => $allMeals['locale'],
                        'meal_id' => $unTransMeal_id,
                    ];
                }
                MealTranslation::insert( $transmeal);
            }
            DB::commit();
            return $this->returnData('Meal', [$unTransMeal_id,$transmeal], 'done');
        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return $this->returnError('Menu', $ex->getMessage());
        }
    }
//_________________________________________________________//
    public function update(MealsRequest $request,$id)
    {
        try{
            $meal= Meal::find($id);
            if(!$meal)
                return $this->returnError('400', 'not found this Meal');
            $allmeal = collect($request->Meal)->all();
            if (!($request->has('meals.is_active')))
                $request->request->add(['is_active'=>0]);
            else
                $request->request->add(['is_active'=>1]);

            $newmeal=Meal::where('meals.id',$id)
                ->update([
                    'image' => $request['image'],
                    'meal_type_id' => $request['meal_type_id'],
                    'is_approved' => $request['is_approved'],
                    'is_active' => $request['is_active'],
                ]);

            $ss=MealTranslation::where('meal_translations.meal_id',$id);
            $collection1 = collect($allmeal);
            $allmeallength=$collection1->count();
            $collection2 = collect($ss);

            $db_meal= array_values(MealTranslation::where('meal_translations.meal_id',$id)
                ->get()
                ->all());
            $dbmeal = array_values($db_meal);
            $request_meal= array_values($request->Meal);
            foreach($dbmeal as $dbmeals){
                foreach($request_meal as $request_meals){
                    $values= MealTranslation::where('meal_translations.meal_id',$id)
                        ->where('locale',$request_meals['locale'])
                        ->update([
                            'title' => $request_meals ['title'],
                            'short_description' => $request_meals ['short_description'],
                            'long_description' => $request_meals ['short_description'],
                            'locale' => $request_meals['locale'],
                            'meal_id' => $id,
                        ]);
                }
            }
            DB::commit();
            return $this->returnData('Meal', [$dbmeal,$values],'done');
        }
        catch(\Exception $ex){
            return $this->returnError('400', $ex->getMessage());
        }
    }
//___________________________________________________________//
    public function search($meal_name)
    {
        try {
            $Meal = DB::table('meal_translations')
                ->where("title", "like", "%" . $meal_name . "%")
                ->get();
            if (!$Meal) {
                return $this->returnError('400', 'not found this Meal');
            } else {
                return $this->returnData('Meal', $Meal, 'done');
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
            $Meal= $this->MealModel::find($id);
            if(is_null($Meal)){
                return $this->returnSuccessMessage('This Meal not found', 'done');}
            else{
                $Meal->is_active =0;
                $Meal->save();
                return $this->returnData('Menu', $Meal, 'This Meal is trashed Now');
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
            $Meal = $this->MealModel::NotActive();
            return $this->returnData('Meal', $Meal, 'done');
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
    public function restoreTrashed( $id)
    {
        try {
            $Meal = $this->MealModel::find($id);
            if (is_null($Meal)) {
                return $this->returnSuccessMessage('This Meal not found', 'done');
            } else {
                $Meal->is_active =1;
                $Meal->save();
                return $this->returnData('Meal', $Meal, 'This Meal is trashed Now');
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
            $Meal = $this->MealModel::find($id);
            if ($Meal->is_active == 0) {
                $Meal ->delete();
                $Meal ->MealTranslations()->delete();
                return $this->returnData('Meal', $Meal, 'This Meal is deleted Now');
            }
            else {
                return $this->returnData('Meal', $Meal, 'This Meal can not deleted Now');
            }
        } catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }

    }
}
