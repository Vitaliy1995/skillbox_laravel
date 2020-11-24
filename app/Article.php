<?php

namespace App;

use App\Notifications\ArticleCreated;
use App\Notifications\ArticleDeleted;
use App\Notifications\ArticleEdited;

/**
 * @property mixed tags
 */
class Article extends \Illuminate\Database\Eloquent\Model
{
    public $fillable = ['slug', 'name', 'annotation', 'description', 'owner_id', 'published'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($article) {
            User::admin()->notify(new ArticleCreated($article));
        });

        static::updated(function ($article) {
            User::admin()->notify(new ArticleEdited($article));
        });

        static::deleted(function ($article) {
            User::admin()->notify(new ArticleDeleted($article));
        });
    }

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
