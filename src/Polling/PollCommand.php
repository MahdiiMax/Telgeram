<?php

namespace MahdiiMax\Telgeram\Polling;

use Illuminate\Console\Command;

class PollCommand extends Command
{
    protected $signature = 'telgeram:poll
                            {--stop-on-empty : Stop when no updates are pending}
                            {--limit=0 : Maximum updates to process (0 = unlimited)}';

    protected $description = 'Poll Telegram for new updates';

    public function handle(Poller $poller): int
    {
        $processed = $poller->run(
            (int) $this->option('limit'),
            (bool) $this->option('stop-on-empty'),
        );
        $this->info("Processed {$processed} update(s).");
        return self::SUCCESS;
    }
}