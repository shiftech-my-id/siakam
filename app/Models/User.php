<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    public $timestamps = false;

    const UNKNOWN_ROLE = 0;
    const ADMINISTRATOR = 1;
    const OPERATOR = 2;
    const TEACHER = 3;
    const STUDENT = 11;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'fullname',
        'password',
        'active',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    protected static $_roles = [
        self::ADMINISTRATOR => 'Administrator',
        self::OPERATOR => 'Operator',
        self::TEACHER => 'Pengajar',
    ];

    protected static $_acl = [
        User::OPERATOR => [
            AclResource::SYSTEM_MENU => true,
            AclResource::USER_ACTIVITY => true,
        ]
    ];

    public static function roles()
    {
        return static::$_roles;
    }

    public function canAccess($resource)
    {
        if ($this->role == self::ADMINISTRATOR) return true;
        $acl = isset(static::$_acl[$this->role]) ? static::$_acl[$this->role] : [];
        return isset($acl[$resource]) && $acl[$resource] == true;
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_datetime = current_datetime();
            $model->created_by_uid = Auth::user()->id;
            return true;
        });

        static::updating(function ($model) {
            $model->updated_datetime = current_datetime();
            $model->updated_by_uid = Auth::user()->id;
            return true;
        });
    }
}
