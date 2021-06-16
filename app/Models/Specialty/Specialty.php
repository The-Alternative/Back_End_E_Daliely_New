<?php

namespace App\Models\Specialty;

use App\Models\Doctors\doctor;
use App\Models\medicalDevice\medicalDevice;
use App\Models\medicalDevice\MedicalDeviceTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Specialty extends Model
{
    use HasFactory;

    protected $table='specialties';
    protected $fillable=['id','name','graduation_year','is_active'];


    //scope
    public function scopeIsActive($query)
    {
        return $query->where('is_active',1);
    }
    public function scopeNotActive($query)
    {
        return $query->where('is_active',0);
    }

    public function ScopeWithTrans($query)
    {
        return $query=Specialty::join('specialty_translation','specialty_translation.specialty_id','=','specialties.id')
            ->where('specialty_translation.locale','=',config::get('app.locale'))
            ->select('specialties.id','specialties.id',
                'specialty_translation.name','specialty_translation.description','specialty_translation.locale');
    }

    public function specialtyTranslation()
    {
        return $this->hasMany(SpecialtyTranslation::class,'specialty_id');
    }
    public function specialty()
    {
        return $this->belongsToMany(Specialty::class);
    }

    public function doctor()
    {
        return $this->belongsToMany(doctor::class);
    }

}
