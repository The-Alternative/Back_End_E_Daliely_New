<?php

namespace App\Models\WorkPlace;

use App\Models\Doctors\doctor;
use App\Models\Hospital\Hospital;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkPlace extends Model
{
    use HasFactory;
    protected $table='work_places';
    protected $fillable=['id','clinic','hospitals_id','work_hours','work_day','doctors_id','location_id','is_active'];
    protected $hidden=['id','created_at','updated_at','doctor_id','location_id','pivot','hospitals_id','doctors_id'];


    //scope
    public function scopeIsActive($query)
    {
        return $query->where('is_active',1)->get();

    }

    public function doctor()
    {
        return $this->belongsToMany(doctor::class);
    }

    public function hospital()
    {
        return $this->hasManyThrough('hospital','doctor');
    }

}
