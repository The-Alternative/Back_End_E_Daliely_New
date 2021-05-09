<?php


namespace App\Models\Doctors;

use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
class DoctorCustomer extends Pivot
{

    use HasFactory;
    protected $table='customer_doctor';
    protected $fillable =['id','doctor_id','customer_id','medical_file_id','age','gender','social_status'
                           ,'blood_type','note','is_active','is_approved'];

    protected $hidden=['created_at','updated_at'];


    public function doctor(){
        return $this->belongsTo(doctor::class);
    }
    public function customer(){
        return $this->belongsTo(customer::class,'customer_doctor_id');
    }

}

