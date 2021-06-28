<?php

namespace App\Models\MenuType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuType extends Model
{
    use HasFactory;

    protected $table=['menu_types'];
    protected $fillable=['id','image','is_active','is_approved'];
    protected $hidden=['created_at','updated_at'];

    public function menutypetranslation()
    {
        return $this->hasMany(MenuTypeTranslation::class);
    }
}