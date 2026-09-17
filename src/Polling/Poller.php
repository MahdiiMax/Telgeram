<?php

namespace MahdiiMax\Telgeram\Polling;

use MahdiiMax\Telgeram\Api\TelegramApi;
use MahdiiMax\Telgeram\Exceptions\TelgeramException;
use MahdiiMax\Telgeram\Updates\UpdateHandler;

class Poller
{
    public function __construct(
        protected TelegramApi $api,
        protected UpdateHandler $updates,
        protected ?int $interval = null,
    ) {}

    public function run(int $limit = 0, bool $stopOnEmpty = false): int
    {
        if (config('telgeram.webhook.enabled', false)) {
            throw new TelgeramException('Cannot poll while the webhook is enabled. Disable telgeram.webhook.enabled first.');
        }
        $interval = $this->interval ?? config('telgeram.polling.interval', 1);
        $offset = 0;
        $processed = 0;
        while ($limit === 0 || $processed < $limit) {
            $response = $this->api->getUpdates([
                'offset' => $offset,
                'timeout' => $interval,
            ]);
            $updates = $response->json('result', []);
            if (!is_array($updates) || $updates === []) {
                if ($stopOnEmpty) {
                    break;
                }
                sleep($interval);
                continue;
            }
            foreach ($updates as $update) {
                $this->updates->handle($update);
                $offset = ((int) ($update['update_id'] ?? 0)) + 1;
                $processed++;
                if ($limit > 0 && $processed >= $limit) {
                    break;
                }
            }
        }
        return $processed;
    }
}