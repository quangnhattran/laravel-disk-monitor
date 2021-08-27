<?php

namespace Qt\DiskMonitor\Http\Controllers;

use Qt\DiskMonitor\Models\DiskMonitorEntry;

class DiskMetricsController
{
    public function index()
    {
        $entries = DiskMonitorEntry::latest()->get();

        return view('disk-monitor::index');
    }
}
