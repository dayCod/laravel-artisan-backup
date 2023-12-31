<?php

namespace DayCod\ArtisanBackup\Function;

use InvalidArgumentException;
use DayCod\ArtisanBackup\Define;

class Helpers
{
    /**
     * Utility for create file name.
     *
     * @param string $format = File Format
     * 
     * @return string $file_name
     */
    public static function FILENAME(string $format): string
    {
        if (!in_array($format, Define::AVAILABLE_BACKUP_TYPE) || $format == "") throw new InvalidArgumentException('format argument must have a valid format');

        return '/db-backup-'.time().".$format";
    }
}
