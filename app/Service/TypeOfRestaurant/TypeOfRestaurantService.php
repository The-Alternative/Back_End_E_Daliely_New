<?php


namespace App\Service\TypeOfRestaurant;


use App\Http\Requests\TypeOfRestaurant\TypeOfRestaurantRequest;
use App\Models\TypeOfRestaurant\TypeOfRestaurant;
use App\Models\TypeOfRestaurant\TypeOfRestaurantTranslation;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class TypeOfRestaurantService
{
    private $TypeOfRestaurantModel;
    use GeneralTrait;


    public function __construct(TypeOfRestaurant $TypeOfRestaurant)
    {
        $this->TypeOfRestaurantModel=$TypeOfRestaurant;

    }
    public function get()
    {
        try{
            $typerestaurant= $this->TypeOfRestaurantModel::Active()->withTrans();
            return $this->returnData('typerestaurant',$typerestaurant,'done');
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }

    public function getById($id)
    {
        try{
            $typerestaurant= $this->TypeOfRestaurantModel->find($id);
            if (is_null($typerestaurant)){
                return $this->returnSuccessMessage('this type of restaurant not found','done');
            }
            else {
                return $this->returnData('type of restaurant', $typerestaurant, 'done');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }

//__________________________________________________________________________//

    public function create( TypeOfRestaurantRequest $request )
    {
        try {
            $alltyperestaurant = collect($request->typerestaurant)->all();
            DB::beginTransaction();
            $unTranstyperestaurant_id =TypeOfRestaurant::insertGetId([
                'image' => $request['image'],
                'is_approved' => $request['is_approved'],
                'is_active' => $request['is_active'],
            ]);
            if (isset($alltyperestaurant)) {
                foreach ($alltyperestaurant as $alltyperestaurants) {
                    $transtyperestaurant[] = [
                        'title' => $alltyperestaurants ['title'],
                        'short_description' => $alltyperestaurants ['short_description'],
                        'long_description' => $alltyperestaurants ['short_description'],
                        'locale' => $alltyperestaurants['locale'],
                        'restaurant_id' => $unTranstyperestaurant_id,
                    ];
                }
                TypeOfRestaurantTranslation::insert( $transtyperestaurant);
            }
            DB::commit();
            return $this->returnData('type of restaurant', [$unTranstyperestaurant_id,  $transtyperestaurant], 'done');
        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return $this->returnError('type of restaurant', $ex->getMessage());
        }
    }
//_________________________________________________________//
    public function update(TypeOfRestaurantRequest $request,$id)
    {
        try{
            $typerestaurant= TypeOfRestaurant::find($id);
            if(!$typerestaurant)
                return $this->returnError('400', 'not found this restaurant');
            $alltyperestaurant = collect($request->typerestaurant)->all();
            if (!($request->has('type_of_restaurant.is_active')))
                $request->request->add(['is_active'=>0]);
            else
                $request->request->add(['is_active'=>1]);

            $newtyperestaurant=TypeOfRestaurant::where('id',$id)
                ->update([
                    'image' => $request['image'],
                    'is_approved' => $request['is_approved'],
                    'is_active' => $request['is_active'],
                ]);

            $ss=TypeOfRestaurantTranslation::where('type_of_restaurant_id',$id);
            $collection1 = collect($alltyperestaurant);
            $allrestauranttypelength=$collection1->count();
            $collection2 = collect($ss);

            $db_restaruranttype= array_values(TypeOfRestaurantTranslation::where('type_of_restaurant_id',$id)
                ->get()
                ->all());
            $dbrestaruranttype = array_values($db_restaruranttype);
            $request_restaruranttype= array_values($request->restaruranttype);
            foreach($dbrestaruranttype as $dbrestaruranttypes){
                foreach($request_restaruranttype as $request_restaruranttypes){
                    $values= TypeOfRestaurantTranslation::where('restaurant_id',$id)
                        ->where('locale',$request_restaruranttypes['locale'])
                        ->update([
                            'title' => $dbrestaruranttypes ['title'],
                            'short_description' => $dbrestaruranttypes ['short_description'],
                            'long_description' => $dbrestaruranttypes ['short_description'],
                            'locale' => $dbrestaruranttypes['locale'],
                            'type_of_restaurant_id' => $id,
                        ]);
                }
            }
            DB::commit();
            return $this->returnData('restaurant type', $dbrestaruranttype,'done');

        }
        catch(\Exception $ex){
            return $this->returnError('400', $ex->getMessage());
        }
    }
//___________________________________________________________//
    public function search($restaurant_type_title)
    {
        try {
            $restauranttype = DB::table('type_of_restaurant_translations')
                ->where("title", "like", "%" . $restaurant_type_title . "%")
                ->get();
            if (!$restauranttype) {
                return $this->returnError('400', 'not found this restaurant type');
            } else {
                return $this->returnData('restaurant type', $restauranttype, 'done');
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
            $restauranttype= $this->TypeOfRestaurantModel::find($id);
            if(is_null($restauranttype)){
                return $this->returnSuccessMessage('This restaurant type not found', 'done');}
            else{
                $restauranttype->is_active =0;
                $restauranttype->save();
                return $this->returnData('doctor', $restauranttype, 'This restaurant type is trashed Now');
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
            $restauranttype = $this->TypeOfRestaurantModel::NotActive()->WithTrans()->all();
            return $this->returnData('restaurant type', $restauranttype, 'done');
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }

    public function restoreTrashed( $id)
    {
        try {
            $restauranttype = $this->TypeOfRestaurantModel::find($id);
            if (is_null($restauranttype)) {
                return $this->returnSuccessMessage('This restaurant type not found', 'done');
            } else {
                $restauranttype->is_active =1;
                $restauranttype->save();
                return $this->returnData('restaurant type', $restauranttype, 'This restaurant type is trashed Now');
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
            $restauranttype = $this->TypeOfRestaurantModel::find($id);
            if ($restauranttype->is_active == 0) {
                $restauranttype = $this->TypeOfRestaurantModel->destroy($id);
            }
            return $this->returnData('restaurant type', $restauranttype, 'This restaurant type is deleted Now');

        } catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }

    }
}
