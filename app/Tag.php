<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];

    private $colorsClasses = [
        'blue' => 'primary',
        'gray' => 'secondary',
        'green' => 'success',
        'red' => 'danger',
        'yellow' => 'warning',
        'aqua' => 'info',
        'white' => 'light',
        'black' => 'dark'
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public function getBootstrapClass()
    {
        return (isset($this->colorsClasses[$this->color]))
            ? $this->colorsClasses[$this->color]
            : $this->colorsClasses['blue'];
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
