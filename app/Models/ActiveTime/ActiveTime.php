<?php

namespace App\Models\ActiveTime;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment\Appointment;

class ActiveTime extends Model
{
    use HasFactory;

    protected $table='active_times';
    protected $fillable=['id','start_time','end_time','is_active','is_approved'];

    public function Appointment()
    {
        return $this->hasMany(appointment::class);
    }

}
