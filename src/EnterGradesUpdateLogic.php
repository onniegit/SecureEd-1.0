<?php

/*Ensure the database was initialized and obtain db link*/
$GLOBALS['dbPath'] = '../db/persistentconndb.sqlite';
$db = new SQLite3($GLOBALS['dbPath'],  $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE , $encryptionKey = "");

if (isset($_POST['submit'])) {
    echo "<br>FILES = ";
    echo print_r($_FILES);
    echo "<br>FILES['file']['type] = " . print_r($_FILES['file']['type']);
    $handle = fopen(($_FILES['file']['tmp_name']), "r");
    echo "<br>handle = " . $handle;
    $headers = fgetcsv($handle, 9001, ",");
    echo "<br>headers = ";
    echo print_r($headers);
    $crn = $_POST['crn'];
    echo "<br>crn = " . $crn;

    $info = pathinfo($_FILES['file']['name']);
    echo "<br>info = ";
    echo print_r($info);

    if($info['extension'] == 'csv') {
        while (($data = fgetcsv($handle, 9001, ",")) !== FALSE) {
            $data[0];
            $data[1];
            echo "<br> Attempting to enter:" . $crn . " with info: ";
            echo print_r($data);
            $db->exec("INSERT INTO Grade VALUES ('$crn', '$data[0]', '$data[1]')");
        }
        $db->backup($db, "temp", $GLOBALS['dbPath']);
        echo "The loop completed.";

        fclose($handle);
    } else echo "File extension is not '.csv'. Please try again.";
}