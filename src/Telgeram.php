<?php

namespace MahdiiMax\Telgeram;

use MahdiiMax\Telgeram\Commands\CommandRegistry;

class Telgeram
{
    public function __construct(
        protected ?string $token = null
    ) {}

    public function getToken(): string
    {
        return $this->token ?? config('telgeram.token');
    }

    public function commands(): CommandRegistry
    {
        return app(CommandRegistry::class);
    }
}
