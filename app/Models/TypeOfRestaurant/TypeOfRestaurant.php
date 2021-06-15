<?php

namespace App\Models\TypeOfRestaurant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfRestaurant extends Model
{
    use HasFactory;
    protected $table='type_of_restaurants';
    protected $fillable =['Id','image','is_active','is_approved'];
    public $timestamps=false;

}
