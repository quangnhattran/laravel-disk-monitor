<?php

namespace Qt\DiskMonitor\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Qt\DiskMonitor\Models\DiskMonitorEntry;

class RecordDiskMetricsCommand extends Command
{
    public $signature = 'disk-monitor:record-metrics ';

    public $description = 'Record disk metrics';

    public function handle()
    {
        collect(config('disk-monitor.disk_names'))->each(fn (string $diskName) => $this->diskMetrics($diskName));

        $this->comment('All done!');
    }

    private function diskMetrics(string $diskName)
    {
        $this->comment("Recording metrics for disk `{$diskName}`...");

        $disk = Storage::disk($diskName);
        $filesCount = count($disk->allFiles());

        DiskMonitorEntry::create([
            'disk_name' => $diskName,
            'files_count' => $filesCount,
        ]);
    }
}
