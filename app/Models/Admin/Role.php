<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Scopes\RoleScope;
use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public $guarded = [];
    protected $primaryKey = 'id';
    protected $table='roles';
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    protected $casts = [
        'is_active' => 'boolean'
    ];
    protected $fillable=['id','slug','is_active'];

    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope(new RoleScope);
    }

    public function RoleTranslation()
    {
        return $this->hasMany(RoleTranslation::class);
    }
    public function permissions()
    {
        return $this->belongsToMany(
            Permission::class,
            'permission_role',
            'role_id',
            'permission_id',
            'id',
            'id');
    }

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'role_user',
            'role_id',
            'user_id',
            'id',
            'id')->withPivot('user_type');
    }
}
