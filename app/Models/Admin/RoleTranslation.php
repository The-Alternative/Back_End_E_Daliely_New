<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleTranslation extends Model
{
    use HasFactory;

    protected $table='role_translation';
    protected $fillable=['id','role_id','name','description','display_name'];

    public function Role()
    {
        return $this->belongsTo(Role::class);
    }
}
