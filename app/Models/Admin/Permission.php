<?php

namespace App\Models\Admin;

use App\Scopes\PermissionScope;
use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    public $guarded = [];
    protected $primaryKey = 'id';
    protected $table='permissions';
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
        static::addGlobalScope(new PermissionScope);
    }

    public function PermissionTranslation()
    {
        return $this->hasMany(PermissionTranslation::class);
    }
}
