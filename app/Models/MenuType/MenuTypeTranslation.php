<?php

namespace App\Models\MenuType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuTypeTranslation extends Model
{
    use HasFactory;
    protected $table=['menu_type_translations'];
    protected $fillable=['id','title','locale','short_description','long_description','menu_type_id'];
    protected $hidden=['created_at','updated_at'];

    public function menutype()
    {
        return $this->belongsTo(MenuType::class);
    }
}
