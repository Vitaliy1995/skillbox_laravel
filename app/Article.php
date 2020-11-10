<?php

namespace App;

class Article extends \Illuminate\Database\Eloquent\Model
{
    public $fillable = ['slug', 'name', 'annotation', 'description'];

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
