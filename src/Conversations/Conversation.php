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
}