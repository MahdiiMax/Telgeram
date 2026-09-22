<?php

namespace MahdiiMax\Telgeram\Database\Contracts;

interface ConversationStore
{
    public function find(string $chatId): ?array;

    public function save(string $chatId, string $conversation, array $state): void;

    public function forget(string $chatId): void;
}