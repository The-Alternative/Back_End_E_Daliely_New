<?php

namespace App\Models\medicalDevice;

use App\Models\Doctors\DoctorTranslation;
use App\Scopes\MedicalDeviceScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctors\doctor;
use Illuminate\Support\Facades\Config;

class medicalDevice extends Model
{
    use HasFactory;

    protected $table='medical_devices';
    protected $fillable=['id','hospital_id','doctor_id','is_active','is_approved'];
    protected $hidden=['pivot','created_at','updated_at','hospital_id','doctor_id'];


    protected static function booted()
    {
        parent::booted(); // TODO: Change the autogenerated stub
        static::addGlobalScope(new MedicalDeviceScope);
    }

    public function scopeNotActive($query)
    {
        return $query->where('is_active',0)->get();
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
