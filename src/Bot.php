<?php

namespace MahdiiMax\Telgeram;

use MahdiiMax\Telgeram\Exceptions\TelgeramException;

class Bot
{
    public function __construct(
        protected string $name,
        protected string $username,
        protected ?string $token = null
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getToken(): string
    {
        if ($this->token === null) {
            throw new TelgeramException('No token provided for bot [' . $this->username . '].');
        }
        return $this->token;
    }
}
