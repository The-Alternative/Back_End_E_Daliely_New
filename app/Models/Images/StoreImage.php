<?php

namespace App\Models\Images;

use App\Models\Stores\Store;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreImage extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table ='store_images';
    protected $fillable = ['store_id','image','is_cover'];

    public function Store()
    {
        return $this->hasMany(Store::class);
    }
}
