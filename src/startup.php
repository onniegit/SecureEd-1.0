<?php

$callConfig = shell_exec('php ../config/ConfigV2.php');
$dbPath = '../db/persistentconndb.sqlite';

//Check if persistentconndb.sqlite exists
if(file_exists($dbPath)) {
    ATTACH ../db/persistentconndb.sqlite AS db;
    //If yes, run config if the database is empty

    if (SELECT name FROM $db {
        echo "<pre>$callConfig</pre>";
    }
} else { //If persistentconndb.sqlite doesn't exist, run config.
    echo "<pre>$callConfig</pre>";
}

//Redirect to /public/index.php
header("Location: ../public/login.php");
