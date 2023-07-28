<?php

namespace DayCod\ArtisanBackup\Abstract;

abstract class BackupRestoreFile
{
    /**
     * Always returns an object which represents the connection to a MySQL Server
     * Regardless of it being successful or not.
     *
     * @param object|false $databaseConnection = MySQL Server Connection
     * @param array $tables = Array of tables that you want to backup
     *
     */
    abstract public function writeBackupFileFromSQL(object|false $databaseConnection, array $tables) :string;
}
