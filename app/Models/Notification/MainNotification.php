<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class MainNotification extends Model
{
    use HasFactory;
    use HasFactory,Notifiable;
    
    protected $table='notifications';

    protected $fillable=['id','notification_id','type','notifiable_id','notifiable_type','data','read_at'];
    protected $casts = [
        'notification_id' => 'integer',
        'id'=>'string',
        'data'=>'array'
      ];


      protected $hidden=['type','id'];
}
