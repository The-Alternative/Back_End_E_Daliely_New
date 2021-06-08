<?php

namespace App\Models\Restaurant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantTranslation extends Model
{
    use HasFactory;
    protected $table='restaurant_translations';
    protected $fillable =['Id','locale','title','description','restaurant_id'];
    public $timestamps=false;
}
