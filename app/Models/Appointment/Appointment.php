<?php

namespace App\Models\Appointment;

use App\Models\Doctors\doctor;
use App\Scopes\AppointmentScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Appointment extends Model
{
    use HasFactory;

    protected $table='Appointments';
    protected $fillable=['id','doctor_id','customer_id','active_times_id','morning_evening','is_active','is_approved'];
    protected $hidden=['created_at','appointment_id','updated_at','doctor_id','customer_id','active_times_id'];

   protected static function boot()
   {
       parent::boot(); // TODO: Change the autogenerated stub
       static::addGlobalScope(new AppointmentScope());
   }

    public function ScopeNotActive($query)
    {
        return $query->where('is_active',0)->get();
    }

    public function doctor()
    {
        return $this->belongsTo(doctor::class);
    }
    public function appointmenttranslation()
    {
        return $this->hasmany(AppointmentTranslation::class);
    }

}
