<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Cache;

class ArticleHistory extends Pivot
{
    protected $guarded = [];

    protected $casts = [
        'changes' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function () {
            Cache::tags('articleHistory')->flush();
        });

        static::updated(function () {
            Cache::tags('articleHistory')->flush();
        });

        static::deleted(function () {
            Cache::tags('articleHistory')->flush();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
