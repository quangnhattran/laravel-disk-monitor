<?php

namespace Qt\DiskMonitor\Tests\Feature\Commands;

use Illuminate\Support\Facades\Storage;
use Qt\DiskMonitor\Commands\RecordDiskMetricsCommand;
use Qt\DiskMonitor\Models\DiskMonitorEntry;
use Qt\DiskMonitor\Tests\TestCase;

class RecordDiskMetricsCommandTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Storage::fake('local');
        Storage::fake('otherDisk');
    }

    /** @test */
    public function record_files_count_for_single_disk()
    {
        $this->artisan(RecordDiskMetricsCommand::class)->assertExitCode(0);
        $this->assertEquals(0, DiskMonitorEntry::last()->files_count);

        Storage::disk('local')->put('test.txt', 'test');
        $this->artisan(RecordDiskMetricsCommand::class)->assertExitCode(0);
        $this->assertEquals(1, DiskMonitorEntry::last()->files_count);
    }

    /** @test */
    public function record_files_count_for_multiple_disks()
    {
        config()->set('disk-monitor.disk_names', ['local', 'otherDisk']);
        Storage::disk('otherDisk')->put('test.txt', 'test');

        $this->artisan(RecordDiskMetricsCommand::class)->assertExitCode(0);
        $entries = DiskMonitorEntry::all();

        $this->assertEquals(2, $entries->count());
        $this->assertEquals('local', $entries[0]->disk_name);
        $this->assertEquals('otherDisk', $entries[1]->disk_name);
        $this->assertEquals(1, $entries[1]->files_count);
    }
}
