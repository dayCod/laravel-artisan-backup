<?php

namespace DayCod\ArtisanBackup\Console\Commands;

use DayCod\ArtisanBackup\ArtisanBackup;
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
        $this->info(ArtisanBackup::mysql());
    }
}
