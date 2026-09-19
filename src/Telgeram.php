<?php

namespace MahdiiMax\Telgeram;

use MahdiiMax\Telgeram\Api\TelegramApi;
use MahdiiMax\Telgeram\Commands\CommandRegistry;
use MahdiiMax\Telgeram\Conversations\ConversationManager;
use MahdiiMax\Telgeram\Messaging\MessageBuilder;

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

    public function chat(int|string $chatId): MessageBuilder
    {
        return MessageBuilder::make(app(TelegramApi::class), (string) $chatId);
    }

    public function conversations(): ConversationManager
    {
        return app(ConversationManager::class);
    }
}
