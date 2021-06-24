<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctors\doctor;

class Hospital extends Model
{
    use HasFactory;
    protected $table='hospitals';
    protected $fillable=['id','name','medical_center','doctor_id','general_hospital','private_hospital','location_id','is_active','is_approved'];
    protected $hidden=['created_at','updated_at','location_id','doctor_id'];
    public $timestamps=false;


    //scope
    public function scopeIsActive($query)
    {
        return $query->where('is_active',1)->get();

    }
    public function scopeNotActive($query)
    {
        return $query->where('is_active',0)->get();

    }

    public function doctor()
    {
        return $this->hasMany(doctor::class);
    }

}
