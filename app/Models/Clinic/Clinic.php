<?php

namespace App\Models\Clinic;

use App\Models\Doctors\doctor;
use App\Models\Clinic\ClinicTranslation;
use App\Scopes\ClinicScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Clinic extends Model
{
    use HasFactory;

    protected $table='clinics';
    protected $fillable=['id','doctor_id','location_id','phone_number','active_time_id','is_active','is_approved'];
// local Scope

    public function scopeIsActive($query)
    {
        return $query->where('is_active',1);

    }
    public function scopeNotActive($query)
    {
        return $query->where('is_active',0);

    }
    //-----------------------------------------------------------------------//
//Global Scope
    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope(new ClinicScope);
    }
//----------------------------------------------------------------------//
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
