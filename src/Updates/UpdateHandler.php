<?php

namespace MahdiiMax\Telgeram\Updates;

use MahdiiMax\Telgeram\Commands\CommandRegistry;
use MahdiiMax\Telgeram\Conversations\ConversationManager;

class UpdateHandler
{
    public function __construct(
        protected CommandRegistry $commands,
        protected ?ConversationManager $conversations = null,
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
        if ($this->conversations !== null && $update->isMessage()) {
            $chatId = $update->chatId();
            if ($chatId !== null && $this->conversations->isActive($chatId)) {
                return $this->conversations->answer($chatId, $update->messageText() ?? '', $update);
            }
        }
        return false;
    }
}