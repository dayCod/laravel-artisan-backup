<?php

namespace DayCod\ArtisanBackup\Function;

abstract class BackupRestoreFile
{
    abstract public function writeBackupFileFromSQL($databaseConnection, array $tables) :string;
}