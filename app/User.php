<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function () {
            Cache::tags('users')->flush();
        });

        static::updated(function () {
            Cache::tags('users')->flush();
        });

        static::deleted(function () {
            Cache::tags('users')->flush();
        });
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public static function admin()
    {
        return self::where('email', config('mail.admin_mail'))->first();
    }

    public function isAdmin()
    {
        return (bool)$this->belongsToMany(Role::class)
            ->wherePivot('role_id', Role::ADMIN);
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'owner_id');
    }
}
