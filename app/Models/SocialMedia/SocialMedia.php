<?php

namespace App\Models\SocialMedia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctors\doctor;

class SocialMedia extends Model
{
    use HasFactory;
    protected $table='social_media';
    protected $fillable=['id','phone_number','whatsapp_number','facebook_account','telegram_number','email','doctor_id','instagram_account','is_active'];
    protected $hidden=['id','created_at','updated_at','doctor_id'];
    public $timestamps =true;

    //scope
    public function scopeIsActive($query)
    {
        return $query->where('is_active',1)->get();
    }
    public function scopeNotActive($query)
    {
        return $query->where('is_active',0)->get();
    }
    public function doctor()
    {
        return $this->belongsTo(doctor::class);
    }
}
