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

            $ss=TypeOfRestaurantTranslation::where('restaurant_id',$id);
            $collection1 = collect($allrestaurant);
            $allrestaurantlength=$collection1->count();
            $collection2 = collect($ss);

            $db_restarurant= array_values(RestaurantTranslation::where('restaurant_id',$id)
                ->get()
                ->all());
            $dbrestarurant = array_values($db_restarurant);
            $request_restarurant= array_values($request->restarurant);
            foreach($dbrestarurant as $dbrestarurants){
                foreach($request_restarurant as $request_restarurants){
                    $values= RestaurantTranslation::where('restaurant_id',$id)
                        ->where('locale',$request_restarurants['locale'])
                        ->update([
                            'title' => $dbrestarurants ['title'],
                            'short_description' => $dbrestarurants ['short_description'],
                            'long_description' => $dbrestarurants ['short_description'],
                            'locale' => $dbrestarurants['locale'],
                            'restaurant_id' => $id,
                        ]);
                }
            }
            DB::commit();
            return $this->returnData('restaurant', $dbrestarurant,'done');

        }
        catch(\Exception $ex){
            return $this->returnError('400', $ex->getMessage());
        }
    }
//___________________________________________________________//
    public function search($restaurant_name)
    {
        try {
            $restaurant = DB::table('restaurant_translations')
                ->where("title", "like", "%" . $restaurant_name . "%")
                ->get();
            if (!$restaurant) {
                return $this->returnError('400', 'not found this restaurant');
            } else {
                return $this->returnData('restaurant', $restaurant, 'done');
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
            $restaurant= $this->TypeOfRestaurantModel::find($id);
            if(is_null($restaurant)){
                return $this->returnSuccessMessage('This restaurant not found', 'done');}
            else{
                $restaurant->is_active = false;
                $restaurant->save();
                return $this->returnData('doctor', $restaurant, 'This restaurant is trashed Now');
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
            $restaurant = $this->TypeOfRestaurantModel::NotActive()->WithTrans()->all();
            return $this->returnData('restaurant', $restaurant, 'done');
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }

    public function restoreTrashed( $id)
    {
        try {
            $restaurant = $this->TypeOfRestaurantModel::find($id);
            if (is_null($restaurant)) {
                return $this->returnSuccessMessage('This restaurant not found', 'done');
            } else {
                $restaurant->is_active = true;
                $restaurant->save();
                return $this->returnData('restaurant', $restaurant, 'This restaurant is trashed Now');
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
            $restaurant = $this->TypeOfRestaurantModel::find($id);
            if ($restaurant->is_active == 0) {
                $restaurant = $this->TypeOfRestaurantModel->destroy($id);
            }
            return $this->returnData('restaurant', $restaurant, 'This restaurant is deleted Now');

        } catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }

    }
}
