<?php

namespace Qt\DiskMonitor;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Qt\DiskMonitor\Commands\RecordDiskMetricsCommand;
use Qt\DiskMonitor\Http\Controllers\DiskMetricsController;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class DiskMonitorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-disk-monitor')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_disk-monitor_table')
            ->hasCommand(RecordDiskMetricsCommand::class);
    }

    public function packageBooted()
    {
        Route::macro(Str::camel($this->package->shortName()), function (string $prefix) {
            Route::prefix($prefix)->group(function () {
                Route::get('/', [DiskMetricsController::class, 'index']);
            });
        });
    }
}
