<?php

namespace App\Jobs;

use App\Article;
use App\Comment;
use App\News;
use App\Tag;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TotalReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $getNewsCount;
    private $getArticlesCount;
    private $getCommentsCount;
    private $getTagsCount;
    private $getUsersCount;

    public function __construct(
        bool $getNewsCount = false,
        bool $getArticlesCount = false,
        bool $getCommentsCount = false,
        bool $getTagsCount = false,
        bool $getUsersCount = false
    )
    {
        $this->getNewsCount = $getNewsCount;
        $this->getArticlesCount = $getArticlesCount;
        $this->getCommentsCount = $getCommentsCount;
        $this->getTagsCount = $getTagsCount;
        $this->getUsersCount = $getUsersCount;
    }

    public function handle()
    {
        $resultMessage = "";
        if ($this->getNewsCount) {
            $resultMessage .= "Новостей: " . News::count() . PHP_EOL;
        }
        if ($this->getArticlesCount) {
            $resultMessage .= "Статей: " . Article::count() . PHP_EOL;
        }
        if ($this->getCommentsCount) {
            $resultMessage .= "Комментарии: " . Comment::count() . PHP_EOL;
        }
        if ($this->getTagsCount) {
            $resultMessage .= "Тегов: " . Tag::count() . PHP_EOL;
        }
        if ($this->getUsersCount) {
            $resultMessage .= "Пользователей: " . User::count() . PHP_EOL;
        }

        echo $resultMessage;
    }
}
