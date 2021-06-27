<?php

namespace App\Models\Doctors;

use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDoctor extends Model
{
    use HasFactory;
    protected $table='customer_doctor';
    protected $fillable =['id','doctor_id','customer_id','medical_file_id','age','gender',
        'social_status','blood_type','note','is_active','is_approved'];

    protected $hidden=['created_at','updated_at','doctor_id','customer_id','medical_file_id',];

    public function scopeNotActive($query)
    {
        return $query->where('is_active',0)->get();
    }
//
//    public function doctor(){
//        return $this->belongsTo(doctor::class);
//    }
//    public function customer(){
//        return $this->belongsTo(customer::class);
//    }
}
