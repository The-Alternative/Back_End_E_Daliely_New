<?php

namespace App\Models\Clinic;

use App\Models\Doctors\doctor;
use App\Models\Clinic\ClinicTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Clinic extends Model
{
    use HasFactory;

    protected $table='clinics';
    protected $fillable=['id','doctors_id','location_id','phone_number','active_time_id','is_active','is_approved'];
//Scope

    public function scopeActive($query)
    {
        return $query->where('is_active',1);

    }

    public function ScopeWithTrans($query)
    {
        return $query=Clinic::join('clinic_translation','clinic_translation.clinic_id','=','clinic_id')
            ->where('clinic_translation.locale','=', Config::get('app.locale'))
            ->select('clinics.*','clinic_translation.*');
    }

    public function clinicTranslation()
    {
        return $this->hasMany(ClinicTranslation::class,'clinic_id');
    }
    public function clinic()
    {
        return $this->belongsToMany(Clinic::class);
    }
    public function doctor()
    {
        return $this->hasOne(doctor::class);
    }
}
