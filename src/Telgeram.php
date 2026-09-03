<?php

namespace MahdiiMax\Telgeram;

class Telgeram
{
    public function __construct(
        protected ?string $token = null
    ) {}

    public function getToken(): string
    {
        return $this->token ?? config('telgeram.token');
    }
}
