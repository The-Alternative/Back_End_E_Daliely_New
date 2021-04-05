<?php

namespace App\Models\Brands;

use App\Models\Brands\BrandTranslation;
use App\Models\Language\Language;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;

    protected $table='brands';

    protected $fillable=['id','slug','image','is_active'];


    //scope
    public function ScopeActive($query)
    {
        return $query->where('is_active',1);
    }

    public function ScopeWithTrans($query)
    {
        return $query=Brands::join('brand_translation','brand_translation.brand_id','=','brand_id')
            ->where('brand_translation.locale','=',get_current_local())
            ->select('brands.*','brand_translation.*');
    }

    public function BrandTranslation()
    {
        return $this->hasMany(BrandTranslation::class,'brand_id');
    }
    public function language()
    {
        return $this->belongsToMany(language::class);
    }
}
