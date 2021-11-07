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

    protected $hidden=['offer_id'];

    protected $casts=[
        'image'=>'array',
    ];
    public function Offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
