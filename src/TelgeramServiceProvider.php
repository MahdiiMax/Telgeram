<?php

namespace MahdiiMax\Telgeram;

use Illuminate\Support\ServiceProvider;

class TelgeramServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/telgeram.php',
            'telgeram'
        );
        $this->app->singleton('telgeram', fn() => new Telgeram());
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/telgeram.php' => config_path('telgeram.php'),
            ], 'telgeram-config');
        }
    }
}
