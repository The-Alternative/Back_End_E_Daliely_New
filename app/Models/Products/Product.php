<?php

namespace App\Models\Products;

use App\Models\Brands\Brands;
use App\Models\Categories\Category;
use App\Models\Categories\Section;
use App\Models\Custom_Fieldes\Custom_Field;
use App\Models\Images\ProductImage;
use App\Models\Stores\Store;
use App\Scopes\ProductScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

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
        'created_at', 'updated_at','pivot'
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

    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope(new ProductScope);
    }

    public function scopeById($query)
    {
      return  $query->join('product_translations', 'product_translations.product_id', '=', 'products.id')
            ->where('product_translations.local','=',Config::get('app.locale'))
            ->select(['products.*',
//                'products.id','products.image','products.is_appear','products.created_at',
                'product_translations.name',
                'product_translations.short_des'])->get();
    }

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

        public function Category(){
        return $this->belongsToMany(Category::class,
            'products_categories',
            'product_id',
            'category_id');
    }
//    public function StoreProduct(){
//        return $this->belongsTo(StoreProduct::class,'product_id');
//    }


    public function Custom_Field()
    {
        return $this->belongsToMany(Custom_Field::class,
            'products_custom_fields',
            'product_id',
            'customfield_id');
    }

        public function ProductImage()
        {
        return $this->hasMany(ProductImage::class);
    }
    public function Section()
    {
        return $this->belongsToMany(
            Section::class,
            'products_sections',
            'product_id',
            'section_id'
            );
    }
     public function Brand()
     {
        return $this->belongsTo(Brands::class);
     }


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

//    public function product_store_ratings(){
//        return $this->hasMany(Product_Store_Rating::class);
//    }
//
//    public function order_details(){
//        return $this->hasMany(Order_Details::class);
//    }
}
