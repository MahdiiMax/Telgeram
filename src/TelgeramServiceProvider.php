<?php

namespace MahdiiMax\Telgeram;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use MahdiiMax\Telgeram\Api\TelegramApi;
use MahdiiMax\Telgeram\Commands\CommandRegistry;
use MahdiiMax\Telgeram\Polling\PollCommand;
use MahdiiMax\Telgeram\Polling\Poller;
use MahdiiMax\Telgeram\Updates\UpdateHandler;
use MahdiiMax\Telgeram\Webhooks\Middleware\ValidateWebhookSecret;
use MahdiiMax\Telgeram\Webhooks\WebhookController;

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
        $this->app->singleton(TelegramApi::class, fn() => new TelegramApi((string) config('telgeram.token')));
        $this->app->singleton(Poller::class);
    }

    public function boot(): void
    {
        foreach ((array) config('telgeram.commands') as $command) {
            app(CommandRegistry::class)->register($command);
        }
        if (config('telgeram.webhook.enabled', false)) {
            Route::post(config('telgeram.webhook.path', 'telgeram/webhook'), WebhookController::class)
                ->middleware(ValidateWebhookSecret::class);
        }
        $this->commands([PollCommand::class]);
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/telgeram.php' => config_path('telgeram.php'),
            ], 'telgeram-config');
        }
    }
}
