<?php

namespace MahdiiMax\Telgeram\Conversations;

use MahdiiMax\Telgeram\Updates\Update;

class ConversationManager
{
    /** @var array<string, Conversation> */
    protected array $conversations = [];

    public function start(int|string $chatId, Conversation $conversation): void
    {
        $this->conversations[$this->key($chatId)] = $conversation;
    }

    public function active(int|string $chatId): ?Conversation
    {
        return $this->conversations[$this->key($chatId)] ?? null;
    }

    public function isActive(int|string $chatId): bool
    {
        return $this->active($chatId) !== null;
    }

    public function answer(int|string $chatId, string $text, Update $update): bool
    {
        $conversation = $this->active($chatId);
        if ($conversation === null) {
            return false;
        }
        $conversation->answer($text, $update);
        return true;
    }

    public function reset(int|string $chatId): void
    {
        unset($this->conversations[$this->key($chatId)]);
    }

    protected function key(int|string $chatId): string
    {
        return (string) $chatId;
    }
}