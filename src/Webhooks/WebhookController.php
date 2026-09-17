<?php

namespace MahdiiMax\Telgeram\Webhooks;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use MahdiiMax\Telgeram\Updates\UpdateHandler;

class WebhookController
{
    public function __construct(
        protected UpdateHandler $updates
    ) {}

    public function __invoke(Request $request): Response
    {
        $payload = json_decode($request->getContent(), true);
        if (!is_array($payload)) {
            return new Response('', 400);
        }
        $this->updates->handle($payload);
        return new Response('', 200);
    }
}
