<?php

namespace App\Models\Appointment;

use App\Models\Doctors\doctor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table='Appointments';
    protected $fillable=['id','doctor_id','customer_id','begin_date','end_date','begin_time','end_time','is_active','is_approved'];


    //Scope
    public function ScopeIsActive($query)
    {
        return $query->where('is_active',1);
    }

    public function doctor()
    {
        return $this->belongsTo(doctor::class);
    }
}
