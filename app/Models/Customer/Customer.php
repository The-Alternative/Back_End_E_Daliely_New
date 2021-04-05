<?php

namespace App\Models\Customer;

use App\Models\Doctors\doctor;
use App\Models\Customer\CustomerTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table='customers';
    protected $fillable=['id','social_media_id','is_active','is_approved'];

    //scope
    public function ScopeActive($query)
    {
        return $query->where('is_active',1);
    }

    public function ScopeWithTrans($query)
    {
        return $query=Customer::join('customer_translations','customer_translations.customer_id','=','customer_id')
            ->where('customer_translations.locale','=',get_current_local())
            ->select('customers.*','customer_translations.*')->get();
    }

    public function customerTranslation()
    {
        return $this->hasMany(customerTranslation::class,'customer_id');
    }

    public function doctor()
    {
        return $this->belongsToMany(doctor::class);
    }
}
