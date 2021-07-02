<?php

namespace App\Models\Specialty;

use App\Models\Doctors\Doctor;
use App\Models\medicalDevice\medicalDevice;
use App\Models\medicalDevice\MedicalDeviceTranslation;
use App\Scopes\SpecialtyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Specialty extends Model
{
    use HasFactory;

    protected $table='specialties';
    protected $fillable=['id','name','graduation_year','is_active'];
    protected $hidden=['created_at','updated_at'];
    protected static function booted()
    {
        parent::booted(); // TODO: Change the autogenerated stub
        static::addGlobalScope(new SpecialtyScope);
    }
    //scope
//    public function scopeIsActive($query)
//    {
//        return $query->where('is_active',1);
//    }
    public function scopeNotActive($query)
    {
        return $query->where('is_active',0)->get();
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
        return $this->belongsToMany(Doctor::class);
    }

}
