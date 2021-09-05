<?php


namespace App\Service\Restaurant;


use App\Http\Requests\Restaurant\RestaurantRequest;
use App\Models\Restaurant\Restaurant;
use App\Models\Restaurant\RestaurantItem;
use App\Models\Restaurant\RestaurantTranslation;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class RestaurantService
{
    private $RestaurantModel;
    use GeneralTrait;


    public function __construct(Restaurant  $restaurant)
    {
        $this->RestaurantModel=$restaurant;

    }
    public function get()
    {
        try{
            $restaurant= $this->RestaurantModel::paginate(5);
            return $this->returnData('restaurant',$restaurant,'done');
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }

    public function getById($id)
    {
        try{
            $restaurant= $this->RestaurantModel->find($id);
            if (is_null($restaurant)){
                return $this->returnSuccessMessage('this Restaurant not found','done');
            }
            else {
                return $this->returnData('Restaurant', $restaurant, 'done');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }

//__________________________________________________________________________//

    public function create( RestaurantRequest $request )
    {
        try {
            $allrestaurant = collect($request->restaurant)->all();
            DB::beginTransaction();
            $unTransrestaurant_id =Restaurant::insertGetId([
                'image' => $request['image'],
                'social_media_id' => $request['social_media_id'],
                'appointment_id' => $request['appointment_id'],
                'active_time_id' => $request['active_time_id'],
                'location_id' => $request['location_id'],
                'is_approved' => $request['is_approved'],
                'is_active' => $request['is_active'],
            ]);
            if (isset($allrestaurant)) {
                foreach ($allrestaurant as $allrestaurants) {
                    $transrestaurant[] = [
                        'title' => $allrestaurants ['title'],
                        'short_description' => $allrestaurants ['short_description'],
                        'long_description' => $allrestaurants ['short_description'],
                        'locale' => $allrestaurants['locale'],
                        'restaurant_id' => $unTransrestaurant_id,
                    ];
                }
                RestaurantTranslation::insert( $transrestaurant);
            }
            DB::commit();
            return $this->returnData('restaurant', [$unTransrestaurant_id,  $transrestaurant], 'done');
        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return $this->returnError('restaurant', $ex->getMessage());
        }
    }
//_________________________________________________________//
    public function update(RestaurantRequest $request,$id)
    {
        try{
            $restaurant= Restaurant::find($id);
            if(!$restaurant)
                return $this->returnError('400', 'not found this restaurant');
            $allrestaurant = collect($request->restaurant)->all();
            if (!($request->has('restaurants.is_active')))
                $request->request->add(['is_active'=>0]);
            else
                $request->request->add(['is_active'=>1]);

            $newrestaurant=Restaurant::where('restaurants.id',$id)
                ->update([
                    'image' => $request['image'],
                    'social_media_id' => $request['social_media_id'],
                    'appointment_id' => $request['appointment_id'],
                    'active_time_id' => $request['active_time_id'],
                    'location_id' => $request['location_id'],
                    'is_approved' => $request['is_approved'],
                    'is_active' => $request['is_active'],
                ]);

            $ss=RestaurantTranslation::where('restaurant_translations.restaurant_id',$id);
            $collection1 = collect($allrestaurant);
            $allrestaurantlength=$collection1->count();
            $collection2 = collect($ss);

            $db_restarurant= array_values(RestaurantTranslation::where('restaurant_translations.restaurant_id',$id)
                ->get()
                ->all());
            $dbrestarurant = array_values($db_restarurant);
            $request_restarurant= array_values($request->restaurant);
            foreach($dbrestarurant as $dbrestarurants){
                foreach($request_restarurant as $request_restarurants){
                    $values= RestaurantTranslation::where('restaurant_translations.restaurant_id',$id)
                        ->where('locale',$request_restarurants['locale'])
                        ->update([
                            'title' => $request_restarurants ['title'],
                            'short_description' => $request_restarurants ['short_description'],
                            'long_description' => $request_restarurants ['short_description'],
                            'locale' => $request_restarurants['locale'],
                            'restaurant_id' => $id,
                        ]);
                }
            }
            DB::commit();
            return $this->returnData('restaurant',[$dbrestarurant,$values],'done');
        }
        catch(\Exception $ex){
            DB::rollBack();
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
            $restaurant= $this->RestaurantModel::find($id);
            if(is_null($restaurant)){
                return $this->returnSuccessMessage('This restaurant not found', 'done');}
            else{
                $restaurant->is_active =0;
                $restaurant->save();
                return $this->returnData('restaurant', $restaurant, 'This restaurant is trashed Now');
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
            $restaurant = $this->RestaurantModel::NotActive();
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
            $restaurant = $this->RestaurantModel::find($id);
            if (is_null($restaurant)) {
                return $this->returnSuccessMessage('This restaurant not found', 'done');
            } else {
                $restaurant->is_active =1;
                $restaurant->save();
                return $this->returnData('restaurant', $restaurant, 'This restaurant is restore trashed Now');
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
            $restaurant = $this->RestaurantModel::find($id);
            if ($restaurant->is_active == 0) {
                $restaurant->delete();
                $restaurant->RestaurantTranslation()->delete();
                return $this->returnData('restaurant', $restaurant, 'This restaurant is deleted Now');
            }
            else
            {
                return $this->returnData('restaurant', $restaurant, 'This restaurant can not deleted Now');
            }

        } catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }

    }

    public function getType($id)
     {
          try{
              $restaurant= Restaurant::with('restaurantType')->find($id);
              return $this->returnData('restaurant',$restaurant,'done');
          } catch (\Exception $ex) {
              return $this->returnError('400', $ex->getMessage());
          }
     }
     public function getCategory($id)
     {
          try{
              $restaurant= Restaurant::with('RestaurantCategory')->find($id);
              return $this->returnData('restaurant',$restaurant,'done');
          } catch (\Exception $ex) {
              return $this->returnError('400', $ex->getMessage());
          }
     }
     public function getProduct($id)
     {
          try{
              $restaurant= Restaurant::with('RestaurantProduct')->find($id);
              return $this->returnData('restaurant',$restaurant,'done');


          } catch (\Exception $ex) {
              return $this->returnError('400', $ex->getMessage());
          }
     }
//_____________________________________insert_______________________________//

public function insertToRestaurantRestaurantType(Request $request)
{
    try{
    $restaurant=Restaurant::find($request->restaurant_id);
    if(!$restaurant)
    return $this->returnError('400','not found this restaurant');
    $restaurant->restaurantType()->syncwithoutdetaching($request->restaurant_type_id);
    return $this->returnData('restaurant',$restaurant,'create done');
}
catch(\Exception $ex){
    return $this->returnError($ex->getcode(),$ex->getMessage());
}
}


public function insertToRestaurantRestaurantcategory(Request $request)
{
    try{
    $restaurant=Restaurant::find($request->restaurant_id);
    if(!$restaurant)
    return $this->returnError('400','not found this restaurant');
    $restaurant->RestaurantCategory()->syncwithoutdetaching($request->restaurant_category_id);
    return $this->returnData('restaurant',$restaurant,'create done');
}
catch(\Exception $ex){
    return $this->returnError($ex->getcode(),$ex->getMessage());
}
}
public function insertToRestaurantRestaurantproduct(Request $request)
{
    try{
    $restaurant=Restaurant::find($request->restaurant_id);
    if(!$restaurant)
    return $this->returnError('400','not found this restaurant');
    $restaurant->RestaurantProduct()->syncwithoutdetaching($request->restaurant_product_id);
    return $this->returnData('restaurant',$restaurant,'create done');
}
catch(\Exception $ex){
    return $this->returnError($ex->getcode(),$ex->getMessage());
}
}
public function insertToRestaurantitem(Request $request)
{
    try{

     $restaurantitem=new RestaurantItem();

     $restaurantitem->item_id   =$request->item_id;
     $restaurantitem->restaurant_id   =$request->restaurant_id;
     $restaurantitem->price   =$request->price;
     $restaurantitem->quantity   =$request->quantity;
     $restaurantitem->is_active   =$request->is_active;
     $restaurantitem->is_approved   =$request->is_approved;

    $result= $restaurantitem->save();
    if(!$result) {
        return $this0>returnError('400','faield save');
    }else{
    return $this->returnData('restaurantItem',$result,'create done');
    }
}
catch(\Exception $ex){
    return $this->returnError($ex->getcode(),$ex->getMessage());
}
}
}
