<?php

namespace MahdiiMax\Telgeram\Updates;

use Illuminate\Support\Arr;

class Update
{
    public const TYPE_MESSAGE = 'message';
    public const TYPE_CALLBACK_QUERY = 'callback_query';

    public function __construct(
        protected array $payload
    ) {}

    public function payload(): array
    {
        return $this->payload;
    }

    public function id(): ?int
    {
        return Arr::get($this->payload, 'update_id');
    }

    public function type(): ?string
    {
        foreach ([self::TYPE_MESSAGE, self::TYPE_CALLBACK_QUERY] as $type) {
            if (Arr::has($this->payload, $type)) {
                return $type;
            }
        }
        return null;
    }

    public function isMessage(): bool
    {
        return $this->type() === self::TYPE_MESSAGE;
    }

    public function isCallbackQuery(): bool
    {
        return $this->type() === self::TYPE_CALLBACK_QUERY;
    }

    public function messageText(): ?string
    {
        return Arr::get($this->payload, 'message.text')
            ?? Arr::get($this->payload, 'message.caption');
    }

    public function messageId(): ?int
    {
        return Arr::get($this->payload, 'message.message_id');
    }

    public function chatId(): int|string|null
    {
        return Arr::get($this->payload, 'message.chat.id')
            ?? Arr::get($this->payload, 'callback_query.message.chat.id');
    }

    public function fromId(): ?int
    {
        return Arr::get($this->payload, 'message.from.id')
            ?? Arr::get($this->payload, 'callback_query.from.id');
    }

    public function isCommand(): bool
    {
        $text = $this->messageText();
        return $text !== null && str_starts_with($text, '/');
    }

    public function callbackQueryId(): ?string
    {
        return Arr::get($this->payload, 'callback_query.id');
    }

    public function callbackData(): ?string
    {
        return Arr::get($this->payload, 'callback_query.data');
    }
}