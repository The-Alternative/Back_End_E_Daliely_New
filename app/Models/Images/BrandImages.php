<?php

namespace App\Models\Images;

use App\Models\Brands\Brand;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandImages extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table ='brand_images';
    protected $fillable = ['brand_id','image','is_cover'];

    public function Brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
