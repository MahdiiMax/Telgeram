<?php

namespace MahdiiMax\Telgeram\Conversations;

use MahdiiMax\Telgeram\Updates\Update;

abstract class Conversation
{
    protected string $name;
    protected array $answers = [];

    public function getName(): string
    {
        return $this->name;
    }

    public function answers(): array
    {
        return $this->answers;
    }

    public function remember(string $key, mixed $value): void
    {
        $this->answers[$key] = $value;
    }

    abstract public function start(Update $update): void;

    abstract public function answer(string $text, Update $update): void;

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'answers' => $this->answers,
        ];
    }

    public static function fromArray(array $data): static
    {
        $conversation = new static();
        $conversation->name = $data['name'] ?? $conversation->name;
        $conversation->answers = $data['answers'] ?? [];
        return $conversation;
    }
}
