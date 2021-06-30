<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuTranslation extends Model
{
    use HasFactory;
    protected $table='menu_translations';
    protected $fillable=['id','menu_id','title','short_description','long_description','locale'];
    protected $hidden=['menu_id','created_at','updated_at'];

    public function Menu()
    {
        return $this->belongsTo(Menu::class,'menu_id');
    }
}
