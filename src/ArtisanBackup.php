<?php

namespace DayCod\ArtisanBackup;

use Illuminate\Support\Facades\Facade;

class ArtisanBackup extends Facade
{
    /**
     * Get the registered name of the artisan-backup static component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'artisan-backup';
    }
}
