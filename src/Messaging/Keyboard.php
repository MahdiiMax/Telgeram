<?php

namespace MahdiiMax\Telgeram\Messaging;

use MahdiiMax\Telgeram\Exceptions\TelgeramException;

class Keyboard
{
    public const TYPE_INLINE = 'inline';
    public const TYPE_REPLY = 'reply';
    protected array $rows = [];
    protected array $currentRow = [];
    protected ?bool $resize = null;
    protected ?bool $oneTime = null;
    protected ?bool $selective = null;

    public function __construct(
        protected string $type = self::TYPE_INLINE,
    ) {}

    public static function inline(): self
    {
        return new self(self::TYPE_INLINE);
    }

    public static function reply(): self
    {
        return new self(self::TYPE_REPLY);
    }

    public function button(Button|string $button, ?string $action = null): self
    {
        if (is_string($button)) {
            $button = Button::make($button);
            if ($this->type === self::TYPE_INLINE) {
                $button->callbackData($action);
            }
        }
        if ($this->type === self::TYPE_INLINE && !$button->hasAction()) {
            throw new TelgeramException(
                'Inline keyboard buttons require a callback data or URL.'
            );
        }
        $this->currentRow[] = $button;
        return $this;
    }

    public function row(): self
    {
        if (!empty($this->currentRow)) {
            $this->rows[] = $this->currentRow;
            $this->currentRow = [];
        }
        return $this;
    }

    public function resize(bool $resize = true): self
    {
        $this->resize = $resize;
        return $this;
    }

    public function oneTime(bool $oneTime = true): self
    {
        $this->oneTime = $oneTime;
        return $this;
    }

    public function selective(bool $selective = true): self
    {
        $this->selective = $selective;
        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $this->row();
        $buttonRows = array_map(
            fn(array $row) => array_map(fn(Button $button) => $button->toArray(), $row),
            $this->rows
        );
        if ($this->type === self::TYPE_INLINE) {
            return ['inline_keyboard' => $buttonRows];
        }
        $payload = ['keyboard' => $buttonRows];
        if ($this->resize !== null) {
            $payload['resize_keyboard'] = $this->resize;
        }
        if ($this->oneTime !== null) {
            $payload['one_time_keyboard'] = $this->oneTime;
        }
        if ($this->selective !== null) {
            $payload['selective'] = $this->selective;
        }
        return $payload;
    }
}
