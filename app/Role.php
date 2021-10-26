<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ADMIN = 1;
    const BASE = 2;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
