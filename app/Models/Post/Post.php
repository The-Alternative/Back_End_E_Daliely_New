<?php

namespace App\Models\Post;

use App\Models\Customer\Customer;
use App\Models\Stores\Store;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table='posts';
    protected $fillable=['id','image','is_active','is_approved'];


    public function PostTranslation()
    {
        return $this->hasMany(PostTranslation::class);
    }

    public function Store()
    {
        return $this->belongsToMany(Store::class,'post_store','post-id','store_id','id','id');
    }

    public function Customer()
    {
        return $this->belongsToMany(Customer::class,'post_customer','post-id','customer_id','id','id');
    }
}
