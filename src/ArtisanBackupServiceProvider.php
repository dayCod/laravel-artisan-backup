<?php

namespace DayCod\ArtisanBackup;

use DayCod\ArtisanBackup\Console\Commands\BackupCommand;
use DayCod\ArtisanBackup\Function\BackupFunc;
use Illuminate\Support\ServiceProvider;

class ArtisanBackupServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('artisan-backup', function () {
            return new BackupFunc();
        });
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                BackupCommand::class,
            ]);
        }
    }
}
