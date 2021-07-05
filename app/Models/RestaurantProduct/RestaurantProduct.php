<?php

namespace App\Models\RestaurantProduct;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantProduct extends Model
{
    use HasFactory;
    protected $table='restaurant_products';
    protected $fillable=['id','item_id','image','is_active','is_approved'];
}
