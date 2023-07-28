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
    protected $signature = 'backup:mysql {--t|type=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for Backup MySQL Database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if($this->option('type')){
            if (in_array($this->option('type'), Define::AVAILABLE_BACKUP_TYPE)) {
                if (!file_exists( base_path(Define::DATABASE_PATH).'mysql/'.$this->option('type') )) {
                    mkdir(base_path(Define::DATABASE_PATH).'mysql/'.$this->option('type'), 0775, true);
                }
    
                ArtisanBackup::mysql(
                    config('database.connection.mysql.host'),
                    config('database.connections.mysql.username'),
                    config('database.connections.mysql.password'),
                    config('database.connections.mysql.database'),
                    '*',
                    $this->option('type')
                );
    
            }else{
                $this->info('Type doesn`t exists');
            }
        }else{
            try {
                $typeChoice = $this->choice(
                    'What is your backup file type?',
                    Define::AVAILABLE_BACKUP_TYPE,
                    0
                );

                if (!file_exists( base_path(Define::DATABASE_PATH).'mysql/'.$typeChoice )) {
                    mkdir(base_path(Define::DATABASE_PATH).'mysql/'.$typeChoice, 0775, true);
                }
        
                ArtisanBackup::mysql(
                    config('database.connection.mysql.host'),
                    config('database.connections.mysql.username'),
                    config('database.connections.mysql.password'),
                    config('database.connections.mysql.database'),
                    '*',
                    $typeChoice
                );
            } catch (\Throwable $th) {
                $this->error($th);
            }
        }

    }
}
