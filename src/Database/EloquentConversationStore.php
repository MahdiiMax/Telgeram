<?php

namespace MahdiiMax\Telgeram\Database;

use MahdiiMax\Telgeram\Database\Contracts\ConversationStore;

class EloquentConversationStore implements ConversationStore
{
    public function __construct(
        protected ConversationSession $session
    ) {}

    public function find(string $chatId): ?array
    {
        $row = $this->session->newQuery()->find($chatId);
        if ($row === null) {
            return null;
        }
        return [
            'conversation' => $row->conversation,
            'state' => $row->state,
        ];
    }

    public function save(string $chatId, string $conversation, array $state): void
    {
        $this->session->newQuery()->updateOrCreate(
            ['chat_id' => $chatId],
            ['conversation' => $conversation, 'state' => $state]
        );
    }

    public function forget(string $chatId): void
    {
        $this->session->newQuery()->where('chat_id', $chatId)->delete();
    }
}