<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public static function tagsCloud()
    {
        return (new static)->has('articles')->get();
    }
}
