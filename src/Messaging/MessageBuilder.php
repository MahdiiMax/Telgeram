<?php

namespace MahdiiMax\Telgeram\Messaging;

use Illuminate\Http\Client\Response;
use MahdiiMax\Telgeram\Api\TelegramApi;
use MahdiiMax\Telgeram\Exceptions\TelgeramException;

class MessageBuilder
{
    protected ?string $text = null;
    protected ?string $parseMode = null;
    protected ?Keyboard $keyboard = null;
    protected ?int $replyToMessageId = null;
    protected ?bool $silent = null;

    public function __construct(
        protected TelegramApi $api,
        protected string $chatId
    ) {}

    public static function make(TelegramApi $api, string $chatId): self
    {
        return new self($api, $chatId);
    }

    public function text(string $text, ?string $parseMode = null): self
    {
        $this->text = $text;
        $this->parseMode = $parseMode;
        return $this;
    }

    public function html(string $text): self
    {
        return $this->text($text, 'html');
    }

    public function markdown(string $text): self
    {
        return $this->text($text, 'markdown');
    }

    public function markdownV2(string $text): self
    {
        return $this->text($text, 'MarkdownV2');
    }

    public function keyboard(Keyboard $keyboard): self
    {
        $this->keyboard = $keyboard;
        return $this;
    }

    public function replyTo(int $messageId): self
    {
        $this->replyToMessageId = $messageId;
        return $this;
    }

    public function silent(bool $silent = true): self
    {
        $this->silent = $silent;
        return $this;
    }

    public function send(): Response
    {
        if ($this->text === null) {
            throw new TelgeramException('Cannot send a message without text.');
        }
        $params = [];
        if ($this->parseMode !== null) {
            $params['parse_mode'] = $this->parseMode;
        }
        if ($this->keyboard !== null) {
            $params['reply_markup'] = $this->keyboard->toArray();
        }
        if ($this->replyToMessageId !== null) {
            $params['reply_to_message_id'] = $this->replyToMessageId;
        }
        if ($this->silent !== null) {
            $params['disable_notification'] = $this->silent;
        }
        return $this->api->sendMessage($this->chatId, $this->text, $params);
    }
}
