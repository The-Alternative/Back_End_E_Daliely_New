<?php

namespace App\Models\Meals;

use App\Models\Restaurant\restaurant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;
    protected $table=['meals'];
    protected $fillable=['id','image','meal_type_id','is_active','is_approved'];
    protected $hidden=['created_at','updated_at','meal_type_id'];

    public function MealTranslations()
    {
        return $this->hasMany(MealTranslation::class);
    }

    public function restaurant()
    {
        return $this->belongsToMany(restaurant::class);
    }

}
