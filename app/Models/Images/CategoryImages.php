<?php

namespace App\Models\Images;

use App\Models\Categories\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryImages extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table ='category_images';
    protected $fillable = ['category_id','image','is_cover'];

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
}
