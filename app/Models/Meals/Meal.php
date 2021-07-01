<?php

namespace App\Models\Meals;

use App\Models\MealType\MealType;
use App\Models\Order\Order;
use App\Models\Restaurant\restaurant;
use App\Scopes\MealScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;
    protected $table='meals';
    protected $fillable=['id','image','meal_type_id','is_active','is_approved'];
    protected $hidden=['created_at','updated_at','meal_type_id'];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::addGlobalScope(new MealScope());
    }
    public function scopeNotActive($query)
    {
        return $query->where('is_active',0)->get();
    }

    public function MealTranslations()
    {
        return $this->hasMany(MealTranslation::class);
    }

    public function restaurant()
    {
        return $this->belongsToMany(restaurant::class);
    }
    public function MealType()
    {
        return $this->belongsToMany(MealType::class);
    }

    public function Order()
    {
        return $this->belongsToMany(Order::class);
    }
}
