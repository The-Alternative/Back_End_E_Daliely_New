<?php

namespace App\Models\Doctors;

use App\Models\Doctors\doctor;
use App\Models\Hospital\Hospital;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorTranslation extends Model
{
    use HasFactory;

    protected $table='doctor_translation';
    protected $fillable=['id','doctor_id','first_name','last_name','description','locale'];

    public function doctor()
    {
        return $this->belongsTo(doctor::class);
    }

}
