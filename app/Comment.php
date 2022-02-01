<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{
    protected $fillable = ['comment', 'owner_id', 'article_id'];

    protected static function boot()
    {
        parent::boot();

        static::created(function () {
            Cache::tags('articleComment')->flush();
        });

        static::updated(function () {
            Cache::tags('articleComment')->flush();
        });

        static::deleted(function () {
            Cache::tags('articleComment')->flush();
        });
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function commentable()
    {
        return $this->morphTo();
    }
}
