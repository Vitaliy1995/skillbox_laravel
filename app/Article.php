<?php

namespace App;

use App\Events\ArticleUpdate;
use App\Notifications\ArticleCreated;
use App\Notifications\ArticleDeleted;
use App\Notifications\ArticleEdited;
use App\Services\Telegram;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

/**
 * @property mixed tags
 */
class Article extends Model implements ModelWithComments
{
    public $fillable = ['slug', 'name', 'annotation', 'description', 'owner_id', 'published'];

    protected $casts = [
        'published' => 'boolean'
    ];

    protected $dispatchesEvents = [
        'updated' => ArticleUpdate::class
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function (Article $article) {
            User::admin()->notify(new ArticleCreated($article));
            app(Telegram::class)->sendMessage("Новая статья: " . route('posts.show', $article));

            Cache::tags(['articles', 'tags'])->flush();
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

            Cache::tags(['articles', 'tags'])->flush();
        });

        static::deleted(function (Article $article) {
            User::admin()->notify(new ArticleDeleted($article));

            Cache::tags('articles')->flush();
        });
    }

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
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
