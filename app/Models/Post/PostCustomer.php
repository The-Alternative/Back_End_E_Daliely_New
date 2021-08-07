<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCustomer extends Model
{
    use HasFactory;
    protected $table='post_customer';
    protected $fillable=['id','post_id','customer_id','like','share','rate','is_active','is_approved'];

    protected $hidden=['post_id','customer_id','created_at','updated_at'];

    //locale scope
    public function scopeNotActive($query)
    {
        return $query->where('is_active',0)->get();
    }
}
