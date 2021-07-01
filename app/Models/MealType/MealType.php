<?php

namespace App\Models\MealType;

use App\Models\Meals\Meal;
use App\Scopes\MealTypeScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealType extends Model
{
    use HasFactory;
    protected $table='meal_types';
    protected $fillable=['id','image','is_active','is_approved'];
    protected $hidden=['created_at','updated_at'];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::addGlobalScope(new MealTypeScope());
    }

    public function scopeNotActive($query)
    {
        return $query->where('is_active',0)->get();
    }

    public function mealtypetranslation()
    {
        return $this->hasMany(MealTypeTranslation::class);
    }

    public function Meal()
    {
        return $this->hasMany(Meal::class);
    }
}
