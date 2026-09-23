<?php

namespace MahdiiMax\Telgeram\Conversations;

use MahdiiMax\Telgeram\Database\Contracts\ConversationStore;
use MahdiiMax\Telgeram\Updates\Update;

class ConversationManager
{
    /** @var array<string, Conversation> */
    protected array $conversations = [];

    public function __construct(
        protected ?ConversationStore $store = null
    ) {}

    public function start(int|string $chatId, Conversation $conversation): void
    {
        $key = $this->key($chatId);
        $this->conversations[$key] = $conversation;
        $this->store?->save($key, $conversation::class, $conversation->toArray());
    }

    public function active(int|string $chatId): ?Conversation
    {
        $key = $this->key($chatId);
        if (isset($this->conversations[$key])) {
            return $this->conversations[$key];
        }
        $row = $this->store?->find($key);
        if ($row === null) {
            return null;
        }
        $conversation = $row['conversation']::fromArray($row['state']);
        $this->conversations[$key] = $conversation;
        return $conversation;
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
        $this->store?->save($this->key($chatId), $conversation::class, $conversation->toArray());
        return true;
    }

    public function reset(int|string $chatId): void
    {
        $key = $this->key($chatId);
        unset($this->conversations[$key]);
        $this->store?->forget($key);
    }

    protected function key(int|string $chatId): string
    {
        return (string) $chatId;
    }
}
