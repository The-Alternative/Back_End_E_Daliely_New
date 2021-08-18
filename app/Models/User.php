<?php

namespace App\Models;

use App\Models\Admin\Permission;
use App\Models\Admin\Role;
use App\Models\Doctors\Patient;
use App\Models\Offer\Offer;
use App\Models\SocialMedia\SocialMedia;
use App\Models\Admin\TransModel\UserTranslation;
use App\Models\Admin\TypeUser;
use App\Models\Stores_Orders\Stores_Order;
use App\Scopes\UserScope;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable implements JWTSubject
{
    use LaratrustUserTrait;
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'age',
        'location_id',
        'social_media_id',
        'is_active',
        'image',
        'email',
        'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope(new UserScope);
    }
    public function UserTranslation()
    {
        return $this->hasMany(UserTranslation::class);
    }
    public function TypeUser(){
        return $this->belongsToMany(TypeUser::class,
            'user_types',
            'user_id',
            'type_id');
    }
    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'role_user',
            'user_id',
            'role_id',
            'id',
            'id');
    }
    public function permissions()
    {
        return $this->belongsToMany(
            Permission::class,
            'permission_user',
            'user_id',
            'permission_id',
            'id',
            'id');
    }
    public function Stores_Order()
    {
        return $this->hasMany(Stores_Order::class);
    }

    public function Patient()
    {
        return $this->hasMany(Patient::class);
    }
    public function socialMedia()
    {
        return $this->hasMany(SocialMedia::class);
    }
    public function Offer()
    {
        return $this->belongsToMany(Offer::class,'offer_user','user_id','offer_id','id','id');
    }
}
