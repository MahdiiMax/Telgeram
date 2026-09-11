<?php

namespace MahdiiMax\Telgeram\Updates;

use MahdiiMax\Telgeram\Commands\CommandRegistry;

class UpdateHandler
{
    public function __construct(
        protected CommandRegistry $commands
    ) {}

    public function handle(array $payload): bool
    {
        $update = new Update($payload);
        if ($update->isMessage() && $update->isCommand()) {
            return $this->commands->dispatch($update->messageText() ?? '', $payload);
        }
        if ($update->isCallbackQuery()) {
            return $this->commands->dispatch($update->callbackData() ?? '', $payload);
        }
        return false;
    }
}