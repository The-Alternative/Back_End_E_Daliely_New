<?php

namespace App\Models\Offer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Offer\Offer;

class OfferImage extends Model
{
    use HasFactory;

    
    protected $table='offer_images';
    protected  $fillable=['id','offer_id','image','is_cover','is_check'];

    protected $hidden=['offer_id','is_check','created_at','updated_at'];

    protected $casts=[
        'image'=>'array',
    ];

    public function getIsCoverAttribute($value)
    {
        return $value==1 ? 'cover' : 'Not cover';
    }

    public function Offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
