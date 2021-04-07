<?php

namespace App\Models\Stores;


use App\Models\Products\Product;
use App\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $hidden = [
        'created_at', 'updated_at','Pivot'
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'is_approve'=> 'boolean'
    ];
    protected $table = 'stores';
    protected $fillable = ['section_id', 'loc_id', 'country_id',
        'gov_id', 'city_id', 'street_id',
        'offer_id', 'logo', 'rating',
        'followers', 'delivery', 'edalilyPoint',
        'socialMedia_id','is_active','is_approve'
    ];
    public function getIsActiveAttribute($value)
    {
        return $value == 1 ? 'Active' : 'Not Active';
    }
    public function getIsApprovedAttribute($value)
    {
        return $value == 1 ? 'Approved' : 'Not Approved';
    }

    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope(new StoreScope);
    }
//    public function scopeWithTrans($query)
//    {
//        return $query=
//            Store::join('store_translations', 'store_translations.store_id', '=', 'stores.id')
//            ->where('store_translations.local','=',get_current_local())
//            ->select(['stores.*','store_translations.*']);
//    }

    public function StoreTranslation()
    {
        return $this->hasMany(
            StoreTranslation::class,
            'store_id');
    }
    public function Product()
    {
        return $this->belongsToMany(
            Product::class,
            'stores_products',
            'store_id',
            'product_id',
            'id',
            'id')
            ->withPivot(['price','quantity'])
            ->withTimestamps();
    }
//    public function StoreProduct(){
//        return $this->belongsTo(StoreProduct::class,'store_id');
//    }
//    public function Section()
//    {
//        return $this->hasMany(Section::class,'section_id');
//    }
}

