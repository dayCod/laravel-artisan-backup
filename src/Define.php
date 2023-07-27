<?php

namespace DayCod\ArtisanBackup;

class Define
{
    /**
     * Define default path for backup file.
     *
     * @var string $path
     */
    CONST DATABASE_PATH = "/database/backup/";

    /**
     * Define base table that you want to backup.
     *
     * @var string $table
     */
    CONST SELECT_ALL_TABLES = "*";
    
    /**
     * Define default rules for empty string.
     *
     * @var string $rules
     */
    CONST EMPTY_STRING = "";
}

