<?php

namespace App\Models\RestaurantType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantType extends Model
{
    use HasFactory;
    protected $table='restaurant_types';
    protected $fillable =['Id','image','is_active','is_approved'];
    public $timestamps=false;
    protected $hidden=['created_at','updated_at'];

    public function scopeNotActive($query)
    {
        return $query->where('is_active',0);
    }

    public function restaurantTypeTranslation()
    {
        return $this->hasMany(RestaurantTypeTranslation::class);
    }
}
