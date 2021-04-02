<?php

/*Ensure the database was initialized and obtain db link*/
$GLOBALS['dbPath'] = '../db/persistentconndb.sqlite';
$db = new SQLite3($GLOBALS['dbPath'],  $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE , $encryptionKey = "");

if (isset($_POST['submit'])) { //Checks if var is set
    $crn = $_POST['crn']; //grab the CRN from form
    $path = pathinfo($_FILES['file']['name']); //grabs info for the path

    if(path['extension'] == 'csv') { //is file a CSV?
        $handle = fopen(($_FILES['file']['tmp_name']), "r"); //set a read-only pointer at beginning of file
        while (($data = fgetcsv($handle, 100000, ",")) !== FALSE) { //iterate through file
            $db->exec("INSERT INTO Grade VALUES ('$crn', '$data[0]', '$data[1]')");
            //grab info from csv and write to DB
        }
        $db->backup($db, "temp", $GLOBALS['dbPath']); //backup DB
        fclose($handle); //close pointer
    }
    header("Location: ../test/DBcontents.php");
}