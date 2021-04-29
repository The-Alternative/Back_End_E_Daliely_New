<?php

namespace App\Models\Stores;

use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class StoreProduct extends Pivot
{
    use HasFactory;
    protected $table = 'stores_products';

    protected $primaryKey = 'id';
    protected $hidden =
        [
        'created_at', 'updated_at'
        ];
    protected $casts = [
        'is_active' => 'boolean',
        'is_approve'=> 'boolean'
    ];
    protected $fillable =
        [
        'price','quantity'
        ];
    public function Store(){
        return $this->belongsTo(Store::class);
    }
    public function Product(){
        return $this->belongsTo(Product::class);
    }
}
