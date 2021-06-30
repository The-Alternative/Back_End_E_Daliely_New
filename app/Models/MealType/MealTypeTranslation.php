<?php

namespace App\Models\MealType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealTypeTranslation extends Model
{
    use HasFactory;
    protected $table='meal_type_translations';
    protected $fillable=['id','title','locale','short_description','long_description','meal_type_id'];
    protected $hidden=['created_at','updated_at'];

    public function mealtype()
    {
        return $this->belongsTo(MealType::class);
    }
}
