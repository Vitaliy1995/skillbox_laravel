<?php

namespace App;

class Article extends Model
{
    public function getRouteKeyName()
    {
        return "slug";
    }
}
