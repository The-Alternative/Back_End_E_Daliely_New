<?php

namespace App\Models\MedicalFile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalFile extends Model
{
    use HasFactory;

    protected $table='medical_files';
    protected $fillable=['id','doctor_id','customer_id','file_number','file_date','review_date','PDF','is_active','is_approved'];

    //scope
    public function ScopeIsActive($query)
    {
        return $query->where('is_active',1);
    }

}
