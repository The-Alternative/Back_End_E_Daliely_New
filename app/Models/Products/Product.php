<?php

namespace App\Models\Products;

use App\Models\Products\ProductTranslation;
use App\Models\Stores\Store;
<<<<<<< HEAD
<<<<<<< HEAD
=======
use App\Models\Stores\StoreProduct;
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
=======
use App\Models\Stores\StoreProduct;
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
use App\Scopes\ProductScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaravelLocalization;


class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table ='products';

  protected $fillable = [
        'slug','image','category_id','barcode',
      'custom_feild_id', 'brand_id', 'rating_id',
      'offer_id', 'is_appear','is_active'
];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'is_appear'=>'boolean'
    ];

    //________________ scopes begin _________________//

    /****ــــــ This Local Scopes For Products ــــــ  ***
     * @param $query
     * @return
     */
    public function scopeSelectActiveValue($query)
    {
        return $query->select(
            'title', 'slug','brand_id','barcode','image',
            'meta','is_active', 'is_appear','short_des','description')
        ->where('is_active',1)
        ->get();
    }

    /****ــــــ End Of Scopes For Products ــــــ  ****/

    /****ــــــ This Accessors And Mutators For Products ــــــ  ****/
    public function getIsActiveAttribute($value)
    {
       return $value==1 ? 'Active' : 'Not Active';
    }
    public function getIsAppearAttribute($value)
    {
        return $value==1 ? 'Appear' : 'Not Appear';
    }
<<<<<<< HEAD
<<<<<<< HEAD

    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope(new ProductScope);
    }
    public function scopeWithTrans($query)
=======
    protected static function booted()
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
=======
    protected static function booted()
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
    {
        parent::booted();
        static::addGlobalScope(new ProductScope);
    }
//    public function scopeWithTrans($query)
//    {
//        return $query=Product::join('product_translations', 'product_translations.product_id', '=', 'products.id')
//            ->where('product_translations.locale','=',get_current_local())
//            ->select('products.*','product_translations.*')->get();
//    }

    //______________________________ scopes end _____________________________//
    public function ProductTranslation()
    {
        return $this->hasMany(ProductTranslation::class,'product_id');
    }
    public function Store()
    {
        return $this->belongsToMany(
            Store::class,
            'stores_products',
            'product_id',
            'store_id',
            'id',
            'id')
            ->withPivot(['price','quantity'])
            ->withTimestamps();

    }
<<<<<<< HEAD
<<<<<<< HEAD
=======
//    public function StoreProduct(){
//        return $this->belongsTo(StoreProduct::class,'product_id');
//    }
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
=======
//    public function StoreProduct(){
//        return $this->belongsTo(StoreProduct::class,'product_id');
//    }
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
//    public function doctors()
//    {
//        return $this->hasManyThrough('App\Models\Doctor', 'App\Models\Hospital', 'country_id', 'hospital_id', 'id', 'id');
//    }


//    public function customfields()
//    {
//        return $this->belongsToMany(Custom_Field::class)
//        ->withTimestamps()
//        ->withPivot(['value','description']);
//    }
//public function language()
//{
//    return $this->belongsToMany(language::class);
//}
//    public function categories(){
//        return $this->belongsToMany(category::class)
//        ->withTimestamps()
//        ->withPivot(['description']);
//    }

//    public function stores(){
//        return $this->belongsToMany(store::class)
//        ->withTimestamps()
//        ->withPivot(['is_active','is_approve','price','qty']);
//    }
//
//    public function product_images(){
//        return $this->hasMany(product_image::class);
//    }
//    public function brand(){
//        return $this->belongsTo(brand::class);
//    }

    public function product_store_ratings(){
        return $this->hasMany(Product_Store_Rating::class);
    }

    public function order_details(){
        return $this->hasMany(Order_Details::class);
    }
}
