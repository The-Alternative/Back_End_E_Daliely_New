<?php

namespace App\Models\Admin;

use App\Models\Admin\TransModel\TypeUserTranslation;
use App\Models\User;
use App\Scopes\UserTypeScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;

class TypeUser extends Model
{
    use LaratrustUserTrait;
    use HasFactory;
    protected $fillable = ['is_active'];
    protected $table = 'type_users';
    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope(new UserTypeScope);
    }
    public function TypeUserTranslation()
    {
        return $this->hasMany(TypeUserTranslation::class);
    }
    public function User()
    {
        return $this->belongsToMany(User::class,
            'user_types',
            'type_id',
            'user_id');
    }
    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'role_type',
            'type_id',
            'role_id',
            'id',
            'id');
    }
    public function permissions()
    {
        return $this->belongsToMany(
            Permission::class,
            'permission_type',
            'type_id',
            'permission_id',
            'id',
            'id');
    }
}
