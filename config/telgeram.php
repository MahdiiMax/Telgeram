<?php

return [
    /*
     * Your Telegram bot token.
     * Obtain it from @BotFather on Telegram.
     */
    'token' => env('TELGERAM_TOKEN'),

    /*
     * Your bot's username (without the leading @).
     */
    'username' => env('TELGERAM_USERNAME'),

    /*
     * Default message parse mode.
     * Allowed: html | markdown | MarkdownV2
     */
    'parse_mode' => env('TELGERAM_PARSE_MODE', 'html'),

    /*
     * HTTP timeout (seconds) when talking to the Telegram API.
     */
    'http_timeout' => (int) env('TELGERAM_HTTP_TIMEOUT', 30),

    /*
     * Webhook settings
     */
    'webhook' => [
        'url' => env('TELGERAM_WEBHOOK_URL'),
        'secret' => env('TELGERAM_WEBHOOK_SECRET'),
    ],

    /*
     * Polling settings 
     */
    'polling' => [
        'interval' => (int) env('TELGERAM_POLLING_INTERVAL', 1),
    ],

    /*
     * Database settings for conversation state.
     */
    'db' => [
        'connection' => null,
        'table' => 'conversation_sessions',
    ],
];
