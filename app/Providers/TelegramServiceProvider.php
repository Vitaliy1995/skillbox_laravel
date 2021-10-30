<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TelegramServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\App\Services\Telegram::class, function () {
            return new \App\Services\Telegram(
                config('telegram.api.host'),
                config('telegram.api.botUri'),
                config('telegram.api.methods'),
                config('telegram.chatId')
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
