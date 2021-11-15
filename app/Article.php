<?php

namespace App;

use App\Notifications\ArticleCreated;
use App\Notifications\ArticleDeleted;
use App\Notifications\ArticleEdited;
use Illuminate\Support\Arr;

/**
 * @property mixed tags
 */
class Article extends \Illuminate\Database\Eloquent\Model
{
    public $fillable = ['slug', 'name', 'annotation', 'description', 'owner_id', 'published'];

    protected $casts = [
        'published' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function (Article $article) {
            User::admin()->notify(new ArticleCreated($article));
            app(\App\Services\Telegram::class)->sendMessage("Новая статья: " . route('posts.show', $article));
        });

        static::updated(function (Article $article) {
            User::admin()->notify(new ArticleEdited($article));

            $after = $article->getDirty();

            $article->history()->attach(auth()->id(), [
                'changes->before' => json_encode(Arr::only(
                    $article->fresh()->toArray(),
                    array_keys($after)
                )),
                'changes->after' => json_encode($after)
            ]);
        });

        static::deleted(function (Article $article) {
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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function history()
    {
        return $this->belongsToMany(User::class, 'article_histories')
            ->using(ArticleHistory::class)
            ->withPivot('changes')
            ->withTimestamps();
    }
}
