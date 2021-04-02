<?php
try {
    //Ensure the database was initialized and obtain db link
    $GLOBALS['dbPath'] = '../db/persistentconndb.sqlite';
    $db = new SQLite3($GLOBALS['dbPath'],  $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE , $encryptionKey = "");

    if (isset($_POST['submit'])) { //checks if submit var is set
        $handle = fopen(($_FILES['file']['tmp_name']), "r"); //sets a read-only pointer at beginning of file
        $crn = $_POST['crn']; //grabs CRN from form
        $path = pathinfo($_FILES['file']['name']); //path info for file

        if($path['extension'] == 'csv') { //check if file is .csv
            while (($data = fgetcsv($handle, 9001, ",")) !== FALSE) { //iterate through csv
                $db->exec("INSERT INTO Grade VALUES ('$crn', '$data[0]', '$data[1]')"); //populate db from csv
            }

            $db->backup($db, "temp", $GLOBALS['dbPath']);
            fclose($handle);
        }

        header("Location: ../public/dashboard.php");
    }
}
catch(Exception $e)
{
    var_dump(debug_backtrace ());
}