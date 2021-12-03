<?php

namespace App\Events;

use App\Article;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ArticleUpdate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $name;
    public $changes;
    public $link;

    public function __construct(Article $article)
    {
        $this->name = $article->name;
        $this->changes = json_encode($article->getDirty());
        $this->link = route('post.show', $article);
    }

    public function broadcastOn()
    {
        return new PrivateChannel('article-update');
    }
}
