<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalTranslation extends Model
{
    use HasFactory;
    protected $table='hospital_translations';
    protected $fillable=['id','hospital_id','name','description','locale'];

    public function Hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
