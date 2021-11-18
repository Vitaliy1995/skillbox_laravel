<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model implements ModelWithComments
{
    protected $fillable = ['title', 'description', 'published'];

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
