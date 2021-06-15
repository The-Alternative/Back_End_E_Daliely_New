<?php


namespace App\Service\Restaurant;


use App\Http\Requests\Restaurant\RestaurantRequest;
use App\Models\Restaurant\restaurant;
use App\Models\Restaurant\RestaurantTranslation;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class RestaurantService
{
    private $RestaurantModel;
    use GeneralTrait;


    public function __construct(restaurant $restaurant)
    {
        $this->RestaurantModel=$restaurant;

    }
    public function get()
    {
        try{
            $restaurant= $this->RestaurantModel::Active()->withTrans();
            return $this->returnData('doctor',$restaurant,'done');
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
            $unTransrestaurant_id =restaurant::insertGetId([
                'image' => $request['image'],
                'social_media_id' => $request['social_media_id'],
                'appointment_id' => $request['appointment_id'],
                'active_time_id' => $request['active_time_id'],
                'customer_id' => $request['customer_id'],
                'location_id' => $request['location_id'],
                'user_id' => $request['user_id'],
                'rate_id' => $request['rate_id'],
                'type_of_restaurant_id' => $request['type_of_restaurant_id'],
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
            $restaurant= restaurant::find($id);
            if(!$restaurant)
                return $this->returnError('400', 'not found this restaurant');
            $allrestaurant = collect($request->restaurant)->all();
            if (!($request->has('restaurant.is_active')))
                $request->request->add(['is_active'=>0]);
            else
                $request->request->add(['is_active'=>1]);

            $newrestaurant=restaurant::where('id',$id)
                ->update([
                    'image' => $request['image'],
                    'social_media_id' => $request['social_media_id'],
                    'appointment_id' => $request['appointment_id'],
                    'active_time_id' => $request['active_time_id'],
                    'customer_id' => $request['customer_id'],
                    'location_id' => $request['location_id'],
                    'user_id' => $request['user_id'],
                    'rate_id' => $request['rate_id'],
                    'type_of_restaurant_id' => $request['type_of_restaurant_id'],
                    'is_approved' => $request['is_approved'],
                    'is_active' => $request['is_active'],
                ]);

            $ss=RestaurantTranslation::where('restaurant_id',$id);
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
            $restaurant= $this->RestaurantModel::find($id);
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
            $restaurant = $this->RestaurantModel::NotActive()->WithTrans()->all();
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
            $restaurant = $this->RestaurantModel::find($id);
            if ($restaurant->is_active == 0) {
                $restaurant = $this->RestaurantModel->destroy($id);
            }
            return $this->returnData('restaurant', $restaurant, 'This restaurant is deleted Now');

        } catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }

    }

}
