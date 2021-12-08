<?php

namespace App\Providers;

use App\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('layouts.right_menu', function ($view) {
            $tagsCloud = Cache::tags('tags')->remember('tagsCloud', 3600, function () {
                return Tag::tagsCloud();
            });
            $view->with('tagsCloud', $tagsCloud);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
