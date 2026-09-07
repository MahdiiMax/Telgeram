<?php

namespace MahdiiMax\Telgeram\Api;

use Illuminate\Http\Client\Factory as HttpClient;
use Illuminate\Http\Client\Response;
use MahdiiMax\Telgeram\Exceptions\TelgeramException;

class TelegramApi
{
    public const BASE_URL = 'https://api.telegram.org/bot';

    public function __construct(
        protected string $token,
        protected ?HttpClient $http = null,
    ) {
        $this->http ??= new HttpClient();
    }

    protected function baseUrl(): string
    {
        return self::BASE_URL . $this->token;
    }

    /**
     * @param array<string, mixed> $params
     */
    public function request(string $method, array $params = []): Response
    {
        $response = $this->http->post("{$this->baseUrl()}/{$method}", $params);
        if ($response->failed()) {
            throw new TelgeramException(
                "Telegram API error for [{$method}]: {$response->body()}"
            );
        }
        return $response;
    }

    public function getMe(): Response
    {
        return $this->request('getMe');
    }

    public function sendMessage(string $chatId, string $text, array $extra = []): Response
    {
        return $this->request('sendMessage', array_merge([
            'chat_id' => $chatId,
            'text' => $text,
        ], $extra));
    }
}
