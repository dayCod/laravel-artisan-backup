<?php

namespace DayCod\ArtisanBackup\Function;

use InvalidArgumentException;

class Helpers
{
    public static function FILENAME(string $format): string
    {
        if (!in_array($format, ['.sql']) || $format == "") throw new InvalidArgumentException('format argument must have a valid format');

        return '/db-backup-'.time().'.sql';
    }
}
