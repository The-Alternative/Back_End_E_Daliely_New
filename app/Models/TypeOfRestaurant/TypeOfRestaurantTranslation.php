<?php

namespace App\Models\TypeOfRestaurant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfRestaurantTranslation extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table='type_of_restaurant_translations';
    protected $fillable =['Id','locale','title','short_description','long_description','type_of_restaurant_id'];
    public $timestamps=false;

}
