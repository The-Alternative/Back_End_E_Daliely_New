<?php

namespace App\Models\Meals;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealTranslation extends Model
{
    use HasFactory;
    protected $table=['meal_translations'];
    protected $fillable=['id','meal_id','title','short_description','long_description','locale'];
    protected $hidden=['created_at','updated_at','meal_id'];

    public function Meal()
    {
        return $this->belongsTo(Meal::class);
    }
}
