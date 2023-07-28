<?php

namespace DayCod\ArtisanBackup\Files;

use DayCod\ArtisanBackup\Abstract\BackupRestoreFile;

class Sql extends BackupRestoreFile
{
    /**
     * Method for write backup SQL file from MySQL Database.
     *
     * @param $databaseConnection = MySQL Server Connection
     * @param array $tables = Array of tables that you want to backup
     *
     * @return string $fileContent
     */
    public function writeBackupFileFromSQL($databaseConnection, array $tables) :string
    {
        $fileContent = '';

        //cycle through
        foreach ($tables as $table) {
            $tableRecords = mysqli_query($databaseConnection, 'SELECT * FROM ' . $table);
            $num_fields = mysqli_num_fields($tableRecords);
            $num_rows = mysqli_num_rows($tableRecords);

            $fileContent .= 'DROP TABLE IF EXISTS ' . $table . ';';
            $createTableQuery = mysqli_fetch_row(mysqli_query($databaseConnection, 'SHOW CREATE TABLE ' . $table));
            $fileContent .= "\n\n" . $createTableQuery[1] . ";\n\n";
            $counter = 1;

            //Over tables
            for ($index = 0; $index < $num_fields; $index++) {   //Over rows
                while ($record = mysqli_fetch_row($tableRecords)) {
                    if ($counter == 1) {
                        $fileContent .= 'INSERT INTO ' . $table . ' VALUES(';
                    } else {
                        $fileContent .= '(';
                    }

                    //Over fields
                    for ($indexOfField = 0; $indexOfField < $num_fields; $indexOfField++) {
                        $record[$indexOfField] = addslashes($record[$indexOfField]);
                        $record[$indexOfField] = str_replace("\n", "\\n", $record[$indexOfField]);
                        if (isset($record[$indexOfField])) {
                            $fileContent .= '"' . $record[$indexOfField] . '"';
                        } else {
                            $fileContent .= '""';
                        }
                        if ($indexOfField < ($num_fields - 1)) {
                            $fileContent .= ',';
                        }
                    }

                    if ($num_rows == $counter) {
                        $fileContent .= ");\n";
                    } else {
                        $fileContent .= "),\n";
                    }
                    ++$counter;
                }
            }

            $fileContent .= "\n\n\n";
        }

        return $fileContent;
    }
}
