<?php

namespace App\Console\Commands;

use App\Article;
use App\Notifications\NewArticles;
use Carbon\Carbon;
use Illuminate\Console\Command;

class NewArticlesMailingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mailing {--period=7}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $articles = Article::with('tags')
            ->where("created_at", '>', Carbon::now()->subDays($this->option('period')))
            ->latest("updated_at")
            ->get();

        \App\User::all()->map->notify(new NewArticles($articles));
    }
}
