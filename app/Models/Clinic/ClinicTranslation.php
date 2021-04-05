<?php

namespace App\Models\Clinic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicTranslation extends Model
{
    use HasFactory;
    protected $table='clinic_translation';
    protected $fillable=['id','clinic_id','name','locale'];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
