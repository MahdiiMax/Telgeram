<?php

namespace MahdiiMax\Telgeram\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string getToken()
 * @method static \MahdiiMax\Telgeram\Commands\CommandRegistry commands()
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
