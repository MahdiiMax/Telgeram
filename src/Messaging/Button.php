<?php

namespace MahdiiMax\Telgeram\Messaging;

class Button
{
    protected ?string $callbackData = null;
    protected ?string $url = null;

    public function __construct(
        protected string $label
    ) {}

    public static function make(string $label): self
    {
        return new self($label);
    }

    public function callbackData(string $callbackData): self
    {
        $this->callbackData = $callbackData;
        return $this;
    }

    public function url(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function hasAction(): bool
    {
        return $this->callbackData !== null || $this->url !== null;
    }

    /**
     * @return array{text: string, callback_data?: string, url?: string}
     */
    public function toArray(): array
    {
        $payload = ['text' => $this->label];
        if ($this->callbackData !== null) {
            $payload['callback_data'] = $this->callbackData;
        } elseif ($this->url !== null) {
            $payload['url'] = $this->url;
        }
        return $payload;
    }
}
