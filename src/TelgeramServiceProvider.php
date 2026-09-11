<?php

namespace MahdiiMax\Telgeram;

use Illuminate\Support\ServiceProvider;
use MahdiiMax\Telgeram\Commands\CommandRegistry;
use MahdiiMax\Telgeram\Updates\UpdateHandler;

class TelgeramServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/telgeram.php',
            'telgeram'
        );
        $this->app->singleton('telgeram', fn() => new Telgeram());
        $this->app->singleton(CommandRegistry::class);
        $this->app->singleton(UpdateHandler::class);
    }

    public function boot(): void
    {
        foreach ((array) config('telgeram.commands') as $command) {
            app(CommandRegistry::class)->register($command);
        }
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/telgeram.php' => config_path('telgeram.php'),
            ], 'telgeram-config');
        }
    }
}
