<?php

namespace MahdiiMax\Telgeram\Commands;

use MahdiiMax\Telgeram\Exceptions\TelgeramException;

class CommandRegistry
{
    /** @var array<string, Command> */
    protected array $commands = [];

    public function register(Command|string $command): self
    {
        if (is_string($command)) {
            if (!is_subclass_of($command, Command::class)) {
                throw new TelgeramException("Class [{$command}] is not a valid Telgeram command.");
            }
            $command = new $command();
        }
        $this->commands[$command->getName()] = $command;
        return $this;
    }

    public function registerMany(array $commands): self
    {
        foreach ($commands as $command) {
            $this->register($command);
        }
        return $this;
    }

    /** @return array<string, Command> */
    public function all(): array
    {
        return $this->commands;
    }

    public function has(string $name): bool
    {
        return isset($this->commands[$name]);
    }

    public function find(string $name): ?Command
    {
        return $this->commands[$name] ?? null;
    }

    public function dispatch(string $text, mixed $update = null): bool
    {
        $parts = preg_split('/\s+/', trim($text)) ?: [];
        $commandName = ltrim($parts[0] ?? '', '/');
        $arguments = array_slice($parts, 1);
        $command = $this->find($commandName);
        if ($command === null) {
            return false;
        }
        $command->handle($update, $arguments);
        return true;
    }
}