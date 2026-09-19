<?php

namespace MahdiiMax\Telgeram\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string getToken()
 * @method static \MahdiiMax\Telgeram\Commands\CommandRegistry commands()
 * @method static \MahdiiMax\Telgeram\Messaging\MessageBuilder chat(int|string $chatId)
 * @method static \MahdiiMax\Telgeram\Conversations\ConversationManager conversations()
 *
 * @see \MahdiiMax\Telgeram\Telgeram
 */
class Telgeram extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'telgeram';
    }
}
