<?php

namespace App\Models\Customer;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTranslation extends Model
{
    use HasFactory;
    protected $table='customer_translations';
    protected $fillable=['id','customer_id','first_name','last_name','address','locale'];

    protected $hidden=[];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
