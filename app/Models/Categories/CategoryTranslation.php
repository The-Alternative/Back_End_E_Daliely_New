<?php

namespace App\Models\Categories;

use App\Models\Language\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['name','local','language_id','category_id'];
    public $timestamps = false;

    /////////////////Begin relation here/////////////////////
    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
    public function language()
    {
        return $this->belongsTo(Language::class,'');
    }



}
