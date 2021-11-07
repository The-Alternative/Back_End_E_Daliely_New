<?php

namespace App\Models\Offer;

use App\Models\Comment\Comment;
use App\Models\Stores\Store;
use App\Models\User;
use App\Models\Offer\OfferImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Scopes\OfferScope;


class Offer extends Model
{
    use HasFactory,Notifiable;

    protected $table='offers';
    protected  $fillable=['id','user_email','store_id','store_product_id','price','selling_price','quantity'
    ,'started_at','ended_at','position','is_active','is_offer','is_approved'];

    // protected $hidden=['position','store_id','store_product_id','created_at','updated_at'];

    protected  $cast=[
        'is_active'=>'boolean',
        'is_approved'=>'boolean',
        'is_offer'=>'boolean'

    ];

    protected static function booted()
    {
        parent::booted(); // TODO: Change the autogenerated stub
        static ::addGlobalScope(new OfferScope());
    }
    //local scope
    public function scopeNotActive($query)
    {
        return $query->where('is_active',0)->get();
    }
    public function scopeAdvertisement($query)
    {
        return $query->select('id','image')->where('is_active',1)->get();
    }
    /////////////////////////////
    public function getIsActiveAttribute($val)
    {
        return $val == 1 ? 'Active':'Not Active';
    }
    public function getIsApprovedAttribute($val)
    {
        return $val == 1 ? 'Approved':'Not Approved';
    }
    public function getIsOfferAttribute($val)
    {
        return $val ==1 ? 'Is Offer' : 'Not Offer';
    }
  ////////////////////////////////////////////////
   public function OfferTranslation()
    {
        return $this->hasMany(OfferTranslation::class);
    }

    public function Store()
    {
        return $this->belongsTo(Store::class);
    }

    public function Comment()
    {
        return $this->hasMany(Comment::class);
    }


    public function OfferImage()
    {
        return $this->hasmany(OfferImage::class);
    }
}
