<?php

namespace App\Models\Offer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferUser extends Model
{
    use HasFactory;
    protected $table='offer_users';
    protected $fillable=['id','offer_id','user_id','interaction_type'];

}
