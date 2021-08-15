<?php

namespace App\Models\Offer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $table='offers';
    protected  $fillable=['id','store_id','store_product_id','price','selling_price','quantity'
    ,'started_at','ended_at','position','is_active','is_offer'];

    protected $hidden=['position','store_id','store_product_id','created_at','updated_at'];

    //local scope
    public function scopeNotActive($query)
    {
        return $query->where('is_active',0)->get();
    }
    public function OfferTranslation()
    {
        return $this->hasMany(OfferTranslation::class);
    }
}
