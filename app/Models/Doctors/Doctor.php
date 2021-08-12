<?php

namespace App\Models\Doctors;

use App\Models\Appointment\Appointment;
use App\Models\Clinic\Clinic;
use App\Models\Customer\Customer;
use App\Models\DoctorRate\DoctorRate;
use App\Models\Hospital\Hospital;
use App\Models\MedicalDevice\MedicalDevice;
use App\Models\MedicalFile\MedicalFile;
use App\Models\SocialMedia\SocialMedia;
use App\Models\Specialty\Specialty;
use App\Scopes\DoctorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table='doctors';
    protected $fillable =['Id','clinic_id','is_approved'];
    protected $hidden   =['created_at','updated_at','clinic_id','pivot'];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::addGlobalScope(new DoctorScope());
    }

    public function scopeNotActive($query)
    {
        return $query->where('is_active',0)->get();
    }

    public function doctorTranslation()
    {
        return $this->hasMany(DoctorTranslation::class,'doctor_id');
    }

    public function socialMedia()
    {
        return $this->hasMany(SocialMedia::class);
    }


    public  function Specialty()
    {
        return $this->belongsToMany(Specialty::class,'doctor_specialty','doctor_id','specialty_id','id','id');
    }

    public  function medicalDevice()
    {
        return $this->belongsToMany(MedicalDevice::class,'doctor_medical_device','doctor_id','medical_device_id','id','id');
    }

    public function DoctorRate()
    {
        return $this->hasOne(DoctorRate::class);
    }

    public  function clinic()
    {
        return $this->hasOne(clinic::class);
    }
    public function hospital()
    {
        return $this->belongsToMany(Hospital::class,'doctor_hospital','doctor_id','hospital_id','id','id');
    }

    public function customer()
    {
        return $this -> belongsToMany(Customer::class,'Customer_Doctor','doctor_id','customer_id','id','id');
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }
    public function MedicalFile()
    {
        return $this->hasMany(MedicalFile::class);
    }
}
