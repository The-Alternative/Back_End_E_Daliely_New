<?php

namespace App\Models\Categories;

use App\Models\Language\Language;
use App\Models\Categories\CategoryTranslation;
use App\Scopes\CategoryScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Spatie\Translatable\HasTranslations;

class Category extends Model
{
//    use HasTranslations;

//    public $translatable = ['name', 'slug'];
    use HasFactory;

    protected $table = 'categories';
    public $timestamps = true;
    protected $fillable = [
      'slug', 'parent_id', 'image', 'is_active'];

    //________________ scopes begin _________________//

    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope(new CategoryScope);
    }

//    public function scopeWithTrans($query)
//    {
//        return $query=Category::join('category_translations', 'category_translations.category_id', '=', 'categories.id')
//            ->where('category_translations.locale','=',get_current_local())
//            ->select('categories.*','category_translations.*');
//    }



    //________________ scopes end _________________//


//    public function language()
//    {
//        return $this->belongsTo(Language::class, 'lang_id', 'id');
//    }
    public function CategoryTranslation()
    {
        return $this->hasMany(CategoryTranslation::class,'category_id');
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
