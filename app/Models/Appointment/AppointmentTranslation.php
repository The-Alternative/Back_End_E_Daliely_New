<?php

namespace App\Models\Appointment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentTranslation extends Model
{
    use HasFactory;


    protected $table='appointment_translation';
    protected $fillable=['id','appointment_id','locale','description'];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
