<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuTranslation extends Model
{
    use HasFactory;
    protected $table='menu_translations';
    protected $fillable=['id','menu_id','locale','name','short_description','long_description'];

    public function Menu()
    {
        return $this->belongsTo(Menu::class,'menu_id');
    }
}
