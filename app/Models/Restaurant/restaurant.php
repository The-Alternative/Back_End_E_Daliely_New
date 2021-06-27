<?php

namespace App\Models\Restaurant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class restaurant extends Model
{
    use HasFactory;

    protected $table='restaurants';
    protected $fillable =['Id','image','appointment_id','location_id','active_time_id','customer_id','social_media_id','type_of_restaurant_id','rate_id','user_id','is_active','is_approved'];
    public $timestamps=false;
    protected $hidden=['appointment_id','location_id','active_time_id','customer_id','social_media_id',
        'type_of_restaurant_id','rate_id','user_id','created_at','updated_at'];

    //scope
    public function scopeNotActive($query)
    {
        return $query->where('is_active',0);
    }
    //________________________________________
    public function RestaurantTranslation()
    {
        return $this->hasMany(RestaurantTranslation::class,'restaurant_id');
    }
}
