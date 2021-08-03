<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostStore extends Model
{
    use HasFactory;
    protected $table='post_store';
    protected $fillable=['id','post_id','store_id','start_date_time','end_date_time','price','new_price','is_active','is_approved'];

}
