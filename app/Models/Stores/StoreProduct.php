<?php

namespace App\Models\Stores;

<<<<<<< HEAD
<<<<<<< HEAD
=======
use App\Models\Products\Product;
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
=======
use App\Models\Products\Product;
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class StoreProduct extends Pivot
{
    use HasFactory;
    protected $table = 'stores_products';

    protected $primaryKey = 'id';
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'is_approve'=> 'boolean'
    ];
    protected $fillable = [
        'price','quantity'
    ];
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
    public function Store(){
        return $this->belongsTo(Store::class);
    }
    public function Product(){
        return $this->belongsTo(Product::class);
    }
<<<<<<< HEAD
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
=======
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
}
