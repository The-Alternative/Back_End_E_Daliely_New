<?php

namespace App\Models\Stores_Orders;

use App\Models\Stores\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stores_Order extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    protected $table = 'stores__orders';
    protected $fillable = ['store_id', 'user_id',
        'total', 'bank_transaction_id'
    ];
    public function Store()
    {
        return $this->belongsTo(Store::class);
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
