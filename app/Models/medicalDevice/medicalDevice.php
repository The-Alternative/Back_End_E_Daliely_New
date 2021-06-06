<?php

namespace App\Models\medicalDevice;

use App\Models\Doctors\DoctorTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctors\doctor;
use Illuminate\Support\Facades\Config;

class medicalDevice extends Model
{
    use HasFactory;

    protected $table='medical_devices';
    protected $fillable=['id','hospital_id','doctor_id','is_active','is_approved'];
//    protected $hidden=['id','pivot','created_at','updated_at','hospital_id','doctor_id'];


    //scope
    public function scopeActive($query)
    {
        return $query->where('is_active',1);
    }
    public function scopeNotActive($query)
    {
        return $query->where('is_active',0);
    }
    public function ScopeWithTrans($query)
    {
        return $query=medicalDevice::join('medical_device_translation','medical_device_translation.medical_device_id','=','medical_device_id')
            ->where('medical_device_translation.locale','=',config::get('app.locale'))
            ->select('medical_devices.*','medical_device_translation.*');
    }
    public function medicaldeviceTranslation()
    {
        return $this->hasMany(medicaldeviceTranslation::class,'medical_device_id');
    }
    public function medicaldevice()
    {
        return $this->belongsToMany(medicalDevice::class);
    }
    public function doctor()

    {
        return $this->belongsToMany(doctor::class);
    }
}
