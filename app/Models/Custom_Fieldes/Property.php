<?php

namespace App\Models\Custom_Fieldes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table= 'properties';

    public function Custom_field ()
    {
        return $this->belongsTo(Custom_Field::class);
    }
}
