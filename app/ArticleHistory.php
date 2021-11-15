<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ArticleHistory extends Pivot
{
    protected $guarded = [];

    protected $casts = [
        'changes' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
