<?php

namespace Qt\DiskMonitor\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Route;
use Orchestra\Testbench\TestCase as Orchestra;
use Qt\DiskMonitor\DiskMonitorServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Qt\\DiskMonitor\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        Route::diskMonitor('disk-monitor');
    }

    protected function getPackageProviders($app)
    {
        return [
            DiskMonitorServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');


        $migration = include __DIR__.'/../database/migrations/create_disk-monitor_table.php.stub';
        $migration->up();
    }
}
