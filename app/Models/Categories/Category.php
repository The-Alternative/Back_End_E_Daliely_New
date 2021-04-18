<?php

namespace App\Models\Categories;


use App\Models\Products\Product;
use App\Scopes\CategoryScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = [
      'slug', 'parent_id', 'image', 'is_active','category_id','section_id'];
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    protected $casts = [
        'is_active' => 'boolean'
    ];
    public $timestamps = false;

    public function getIsActiveAttribute($value)
    {
        return $value==1 ? 'Active' : 'Not Active';
    }

    //________________ scopes begin _________________//

    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope(new CategoryScope);
    }
    public function scopeSelection($query)
    {
        return $query->select('id')->get();
    }

    //________________ scopes end _________________//


//    public function language()
//    {
//        return $this->belongsTo(Language::class, 'lang_id', 'id');
//    }
    public function CategoryTranslation()
    {
        return $this->hasMany(CategoryTranslation::class,'category_id');
    }
    public function Section()
    {
        return $this->belongsTo(Section::class);
    }
    function Category()
    {
        return $this->hasMany($this,'parent_id');
    }
    public function Product()
    {
        return $this->belongsToMany(Product::class,'products_categories',
            'category_id',
            'product_id');
    }

////    public function products(){
////        return $this->belongsToMany(product::class)->withTimestamps()->withPivot(['']);
////    }
//
//    public function stores(){
//        return $this->belongsToMany(Store::class)->withTimestamps();
//    }
//
//    public function categories(){
//        return $this->hasMany(Category::class);
//    }
//    public function category(){
//        return $this->belongsTo(Category::class);
//    }
//    public function store_category_images(){
//        return $this->hasMany(Store_Category_Image::class);
//    }
//}
}
