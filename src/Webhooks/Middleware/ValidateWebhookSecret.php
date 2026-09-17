<?php

namespace MahdiiMax\Telgeram\Webhooks\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ValidateWebhookSecret
{
    public function __construct(
        protected ?string $secret = null
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        $secret = $this->secret ?? config('telgeram.webhook.secret');
        if ($secret !== null && !hash_equals($secret, (string) $request->header('X-Telegram-Bot-Api-Secret-Token'))) {
            throw new HttpException(403, 'Invalid webhook secret token.');
        }
        return $next($request);
    }
}