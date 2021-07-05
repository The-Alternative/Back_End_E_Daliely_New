<?php

namespace App\Models\RestaurantCategory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantCategory extends Model
{
    use HasFactory;
    protected $table='restaurant_categories';
    protected $fillable=['id','image','is_active','is_approved'];

}
