<?php

namespace App\Models\Stores;

use App\Models\Brands\Brand;
use App\Models\Categories\Section;
use App\Models\Images\StoreImage;
use App\Models\Products\Product;
use App\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $hidden = [
        'created_at', 'updated_at'
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
    public function Section()
    {
        return $this->belongsToMany(
            Section::class,
            'stores_sections',
            'store_id',
            'section_id');
    }
    public function StoreProduct()
    {
        return $this->hasMany(StoreProduct::class);
    }
    public function Brand()
    {
        return $this->belongsToMany(Brand::class,'store_brand','store_id','brand_id','id','id');
    }
    public function StoreImage()
    {
        return $this->hasMany(StoreImage::class);
    }
<<<<<<< HEAD

=======
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
}
