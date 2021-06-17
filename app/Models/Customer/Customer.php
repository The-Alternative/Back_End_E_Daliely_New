<?php

namespace App\Models\Customer;

use App\Models\Doctors\doctor;
use App\Models\Customer\CustomerTranslation;
use App\Models\Doctors\DoctorCustomer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Customer extends Model
{
    use HasFactory;
    protected $table='customers';
    protected $fillable=['id','social_media_id','is_active','is_approved'];
    protected $hidden=['created_at','updated_at','social_media_id'];
    //scope
    public function ScopeIsActive($query)
    {
        return $query->where('is_active',1);
    }
    public function ScopeNotActive($query)
    {
        return $query->where('is_active',0);
    }

    public function ScopeWithTrans($query)
    {
        return $query=Customer::join('customer_translations','customer_translations.customer_id','=','customers.id')
            ->where('customer_translations.locale','=',config::get('app.locale'))
            ->select('customers.id','customers.is_active','customers.is_approved',
                'customer_translations.first_name', 'customer_translations.last_name',
                'customer_translations.address' ,'customer_translations.locale')->get();
    }

    public function customerTranslation()
    {
        return $this->hasMany(customerTranslation::class,'customer_id');
    }

    public function doctor()
    {
        return $this->belongsToMany(doctor::class,'customer_doctor')
                    ->using(DoctorCustomer::class)
                    ->withPivot(['medical_file_id','age','gender','social_status'
                                    ,'blood_type','note','is_active','is_approved']);
    }
}
