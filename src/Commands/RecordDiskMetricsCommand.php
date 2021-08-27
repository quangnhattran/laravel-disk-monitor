<?php

namespace Qt\DiskMonitor\Commands;

use Illuminate\Console\Command;

class RecordDiskMetricsCommand extends Command
{
    public $signature = 'laravel-disk-monitor';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
