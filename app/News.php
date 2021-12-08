<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class News extends Model implements ModelWithComments
{
    protected $fillable = ['title', 'description', 'published'];

    protected static function boot()
    {
        parent::boot();

        static::created(function () {
            Cache::tags('news')->flush();
        });

        static::updated(function () {
            Cache::tags('news')->flush();
        });

        static::deleted(function () {
            Cache::tags('news')->flush();
        });
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
