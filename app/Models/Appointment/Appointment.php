<?php

namespace App\Models\Appointment;

use App\Models\Doctors\doctor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Appointment extends Model
{
    use HasFactory;

    protected $table='Appointments';
    protected $fillable=['id','doctor_id','customer_id','active_times_id','morning_evening','is_active','is_approved'];


    //Scope
//    public static function ScopeWithTrans()
//    {
//        return Appointment::join('appointment_translations','appointment_translations.appointment_id','=','appointments.id')
//            ->where('appointment_translations.locale','=', config::get('app.local'))
//            ->select('appointments.id','appointments.is_active','appointments.is_approved',
//                'appointment_translations.description')->get();
//    }

    public function ScopeIsActive($query)
    {
        return $query->where('is_active',1);
    }
    public function ScopeNotActive($query)
    {
        return $query->where('is_active',0);
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
