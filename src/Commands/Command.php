<?php

namespace MahdiiMax\Telgeram\Commands;

abstract class Command
{
    protected string $name;
    protected string $description = '';

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    abstract public function handle(mixed $update, array $arguments = []): void;
}
