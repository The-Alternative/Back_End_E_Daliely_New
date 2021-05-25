<?php

namespace App\Models\Doctors;


use App\Models\Doctors\DoctorTranslation;
use App\Models\Hospital\Hospital;
use App\Models\SocialMedia\SocialMedia;
//use App\Models\WorkPlace\WorkPlace;
use App\Models\Clinic\Clinic;
use App\Models\Specialty\Specialty;
use App\Models\Customer\Customer;
use App\Models\DoctorRate\DoctorRate;
use App\Models\medicalDevice\medicalDevice;
use App\Models\Appointment\Appointment;
use Database\Factories\DoctorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class doctor extends Model
{
    use HasFactory;

    protected $table='Doctors';
    protected $fillable =['Id','image','specialty_id','hospital_id','clinic_id','social_media_id','is_active','is_approved'];
    protected $hidden   =['id','social_media_id','specialty_id','hospital_id','work_places_id','created_at','updated_at'];
     public $timestamps=false;

    protected static function newFactory()
    {
        return DoctorFactory::new();
    }
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
        return $query=doctor::join('doctor_translation','doctor_translation.doctor_id','=','doctor_id')
            ->where('doctor_translation.locale','=', Config::get('app.locale'))
            ->select('doctors.*','doctor_translation.*')->get();
    }

    public function doctorTranslation()
    {
        return $this->hasMany(DoctorTranslation::class,'doctor_id');
    }

    public function socialMedia()
    {
        return $this->hasMany(SocialMedia::class);
    }
//    public  function workPlace()
//    {
//        return $this->belongsToMany(workPlace::class);
//    }

    public  function Specialty()
    {
        return $this->belongsToMany(Specialty::class);
    }

    public  function medicalDevice()
    {
        return $this->belongsToMany(medicalDevice::class);
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
        return $this->belongsToMany(Hospital::class);
    }

    public function customer()
    {
        return $this->belongsToMany(Customer::class)->using(DoctorCustomer::class)
                    ->withPivot(['medical_file_id','age','gender','social_status'
                                 ,'blood_type','note','is_active','is_approved']);
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }


}
