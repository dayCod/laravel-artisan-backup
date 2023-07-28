<?php

namespace DayCod\ArtisanBackup\Function;

use DayCod\ArtisanBackup\Define;
use DayCod\ArtisanBackup\Files\Sql;
use DayCod\ArtisanBackup\Files\Json;

class BackupFunc
{
    /**
     * Method for handling backup database from MySQL.
     *
     * @param string $host = Host of database
     * @param string $user = User of database
     * @param string $pass = Password of database
     * @param string $dbname = Database Name
     * @param string $tables = Name of Tables
     * @param string $option = File Option
     *
     * @return void
     */
    public function mysql($host, $user, $pass, $dbname, $tables = Define::SELECT_ALL_TABLES, $option = Define::EMPTY_STRING) :void
    {
        $databaseConnection = mysqli_connect($host, $user, $pass, $dbname);

        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
        }

        mysqli_query($databaseConnection, "SET NAMES 'utf8'");

        //get all of the tables
        if ($tables == '*') {
            $tables = array();
            $result = mysqli_query($databaseConnection, 'SHOW TABLES');
            while ($row = mysqli_fetch_row($result)) {
                $tables[] = $row[0];
            }
        } else {
            $tables = is_array($tables) ? $tables : explode(',', $tables);
        }

        if($option == 'sql'){
            $sqlInstance = new Sql();
            $fileContent = $sqlInstance->writeBackupFileFromSQL($databaseConnection, $tables);
        }elseif($option == 'json'){
            $jsonInstance = new Json();
            $fileContent = $jsonInstance->writeBackupFileFromSQL($databaseConnection, $tables);
        }

        //save file
        $fileName = base_path(Define::DATABASE_PATH)."mysql/$option".Helpers::FILENAME($option);
        $handle = fopen($fileName, 'w+');
        fwrite($handle, $fileContent);

        if (fclose($handle)) {
            echo "Done, the file name is: " . $fileName;
            exit;
        }
    }
}
