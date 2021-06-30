<?php

namespace App\Models\Admin;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public $guarded = [];

    public function RoleTranslation()
    {
        return $this->hasMany(RoleTranslation::class);
    }
}
