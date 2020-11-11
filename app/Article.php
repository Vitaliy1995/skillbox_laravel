<?php

namespace App;

class Article extends \Illuminate\Database\Eloquent\Model
{
    public $fillable = ['slug', 'name', 'annotation', 'description', 'owner_id', 'published'];

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
