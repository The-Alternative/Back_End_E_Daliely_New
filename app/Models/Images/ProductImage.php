<?php

namespace App\Models\Images;

use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $primaryKey ='id';
    protected $table ='product_images';
    protected $fillable =['product_id','image','is_cover'];
    protected $hidden=['product_id','created_at','updated_at'];

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }

}
