<?php

namespace App\Models\Restaurant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class restaurant extends Model
{
    use HasFactory;

    protected $table='restaurants';
<<<<<<< HEAD
    protected $fillable =['Id','image','appointment_id','location_id','active_time_id','customer_id','social_media_id','type_of_restaurant_id','user_id','rate_id','is_active','is_approved'];
=======
    protected $fillable =['Id','image','appointment_id','location_id','active_time_id','customer_id','social_media_id','type_of_restaurant_id','rate_id','user_id','is_active','is_approved'];
>>>>>>> 321df2e770c526296aa3ca8f506261aa7ea983f7
    public $timestamps=false;


    //scope
    public static function ScopeWithTrans($q)
    {
        return $q=restaurant::join('restaurant_translations','restaurant_translations.restaurant_id','=','restaurant_id')
            ->where('restaurant_translations.locale','=', Config::get('app.locale'))
            ->select('restaurant.*','restaurant_translations.*')->get();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active',1);
    }
    public function scopeNotActive($query)
    {

        return $query->where('is_active',0);

    }
}
