<?php

namespace App\Models\Images;

use App\Models\Custom_Fieldes\Custom_Field;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomFieldImages extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table ='custom_field_images';
    protected $fillable = ['custom_field_id','image','is_cover'];

    public function Custom_Field()
    {
        return $this->belongsTo(Custom_Field::class,'custom_field_id');
    }
}
