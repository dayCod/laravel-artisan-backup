<?php

namespace DayCod\ArtisanBackup\Abstract;

abstract class BackupRestoreFile
{
    abstract public function writeBackupFileFromSQL(object|false $databaseConnection, array $tables) :string;
}
