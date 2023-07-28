<?php

namespace DayCod\ArtisanBackup\Abstract;

abstract class BackupRestoreFile
{
    abstract public function writeBackupFileFromSQL($databaseConnection, array $tables) :string;
}
