<?php

namespace App\Models\Doctors;

use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CustomerDoctor extends Pivot
{
    use HasFactory;
    protected $table='customer_doctor';
    protected $fillable =['id','doctor_id','customer_id','age','gender',
        'social_status','blood_type','note','medical_file_number','medical_file_date','review_date'
        ,'PDF','is_active','is_approved'];

    protected $hidden=['created_at','updated_at','doctor_id','customer_id'];

    public function scopeNotActive($query)
    {
        return $query->where('is_active',0)->get();
    }
//
//    function doctor()
//    {
//        return $this->belongsTo(Doctor::class);
//    }
//
//    function customer()
//    {
//        return $this->belongsTo(Customer::class);
//    }
}
