<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    
    protected $table='notifications';

    protected $fillable=['id','type','notifiable_id','notifiable_type','data','read_at'];
    protected $casts = [
        'id' => 'string',
        'data'=>'array'
      ];

      protected $hidden=['type'];
}
