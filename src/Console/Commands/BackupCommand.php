<?php

namespace DayCod\ArtisanBackup\Console\Commands;

use DayCod\ArtisanBackup\ArtisanBackup;
use DayCod\ArtisanBackup\Define;
use Illuminate\Console\Command;

class BackupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:db {--t|type=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (!file_exists( base_path(Define::DATABASE_PATH).$this->option('type') )) {
            mkdir(base_path(Define::DATABASE_PATH).$this->option('type'), 0775, true);
        }

        ArtisanBackup::mysql(
            config('database.connection.mysql.host'),
            config('database.connections.mysql.username'),
            config('database.connections.mysql.password'),
            config('database.connections.mysql.database'),
            '*',
            $this->option('type')
        );
    }
}
