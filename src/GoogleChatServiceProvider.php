<?php

namespace NghiaKun\LaravelChatApi;

use Illuminate\Support\ServiceProvider;

class GoogleChatServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/google-chat.php', 'google-chat');

        $this->app->singleton('google-chat', function () {
            return new GoogleChatService();
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/google-chat.php' => config_path('google-chat.php'),
            ], 'google-chat-config');
        }
    }
}
