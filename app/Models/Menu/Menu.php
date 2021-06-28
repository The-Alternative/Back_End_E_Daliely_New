<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table='menus';
    protected $fillable=['id','image','menu_type_id','restaurant_id','is_active','is_approved'];
    protected $hidden=['menu_type_id','restaurant_id','created_at','updated_at'];


    public function MenuTranslation()
    {
        return $this->hasMany(MenuTranslation::class);
    }
}
