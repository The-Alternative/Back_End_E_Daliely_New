<?php

namespace App\Models\Order;

use App\Models\Meals\Meal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table='orders';
    protected $fillable =['Id','customer_id','date','total','is_active','is_approved'];
    protected $hidden   =['customer_id','created_at','updated_at'];

    public function scopeNotActive($query)
    {
        return $query->where('is_active',0)->get();
    }
    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }
}
