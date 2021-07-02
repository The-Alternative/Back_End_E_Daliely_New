<?php

namespace App\Models\Custom_Fieldes;

use App\Models\Images\CustomFieldImages;
use App\Models\Products\Product;
use App\Scopes\CustomFieldScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custom_Field extends Model
{
    use HasFactory;
    protected $table='custom_fields';
    protected $fillable = ['image','is_active'];

    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope(new CustomFieldScope);
    }
    public function Custom_Field_Translation()
    {
        return $this->hasMany(
            Custom_Field_Translation::class,
            'store_id');
    }
    public function Product()
    {
        return $this->belongsToMany(Product::class,
            'products_custom_fields',
            'customfield_id',
            'product_id');
    }
    public function Custom_Field_Value()
    {
        return $this->hasMany(Custom_Field_Value::class,'custom_field_id');
    }
    public function CustomFieldImages()
    {
        return $this->hasMany(CustomFieldImages::class,'custom_field_id');
    }
}
