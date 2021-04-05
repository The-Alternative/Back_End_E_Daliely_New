<?php

namespace App\Models\Stores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = 'stores';
    protected $fillable = ['title', 'user_id', 'is_active', 'is_approved',
                           'default_language', 'phone_number', 'business_email', 'logo', 'address', 'location',
                           'working_hours', 'working_days'];
}
