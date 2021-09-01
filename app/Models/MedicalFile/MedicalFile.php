<?php

namespace App\Models\MedicalFile;

use App\Models\Customer\Customer;
use App\Models\Doctors\doctor;
use App\Models\Doctors\CustomerDoctor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalFile extends Model
{
    use HasFactory;

    protected $table='medical_files';
    protected $fillable=['id','doctor_id','customer_id','file_number','file_date','review_date','PDF','is_active','is_approved'];
    protected $hidden=['doctor_id','customer_id','created_at','updated_at'];
    //scope
    public function ScopeIsActive($query)
    {
        return $query->where('is_active',1);
    }
    public function ScopeNotActive($query)
    {
        return $query->where('is_active',0);
    }
    public function Doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function Customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
