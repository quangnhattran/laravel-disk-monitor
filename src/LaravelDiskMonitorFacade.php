<?php

namespace Qt\LaravelDiskMonitor;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Qt\LaravelDiskMonitor\LaravelDiskMonitor
 */
class LaravelDiskMonitorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-disk-monitor';
    }
}
