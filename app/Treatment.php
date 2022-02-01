<?php

namespace App;

use Illuminate\Support\Facades\Cache;

class Treatment extends \Illuminate\Database\Eloquent\Model
{
    public $fillable = ['email', 'message'];

    protected static function boot()
    {
        parent::boot();

        static::created(function () {
            Cache::tags('treatment')->flush();
        });

        static::updated(function () {
            Cache::tags('treatment')->flush();
        });

        static::deleted(function () {
            Cache::tags('treatment')->flush();
        });
    }
}
