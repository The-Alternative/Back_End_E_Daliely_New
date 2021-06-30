<?php

namespace App\Models\MealType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealType extends Model
{
    use HasFactory;
    protected $table=['meal_types'];
    protected $fillable=['id','image','is_active','is_approved'];
    protected $hidden=['created_at','updated_at'];

    public function mealtypetranslation()
    {
        return $this->hasMany(MealTypeTranslation::class);
    }
}
