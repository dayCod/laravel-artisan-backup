<?php

namespace DayCod\ArtisanBackup\Files;

use DayCod\ArtisanBackup\Abstract\BackupRestoreFile;

class Json extends BackupRestoreFile
{
    /**
     * Method for write backup JSON file from MySQL Database.
     *
     * @param $databaseConnection = MySQL Server Connection
     * @param array $tables = Array of tables that you want to backup
     *
     * @return string $fileContent
     */
    public function writeBackupFileFromSQL($databaseConnection, array $tables) :string
    {
        // Base Object Structure
        $fileContent = (object) [
            'title' => 'Backup Database to JSON File',
            'date' => date('Y-m-d'),
            'tables' => []
        ];

        // Loop the tables
        foreach ($tables as $table) {
            $tableRecords = mysqli_query($databaseConnection, "SELECT * FROM $table");
            $num_rows = mysqli_num_rows($tableRecords);

            // Base Table Object Structure
            $tableObject = (object) [
                'name' => $table,
                'records' => []
            ];

            if($num_rows > 0){
                // Get Record of Tables and Store to Table Object Records
                while ($record = mysqli_fetch_assoc($tableRecords)) {
                    array_push($tableObject->records, (object) $record);
                }
            }

            // Store Table Object to Base Object
            array_push($fileContent->tables, $tableObject);
        }

        return json_encode($fileContent);
    }
}
