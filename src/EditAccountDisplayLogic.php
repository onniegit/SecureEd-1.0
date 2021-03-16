<?php
/*Ensure the database was initialized and obtain db link*/
$GLOBALS['dbPath'] = '../db/persistentconndb.sqlite';
$db = new SQLite3($GLOBALS['dbPath'],  $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE , $encryptionKey = "");

/*Get information from the post request*/

    $email = $_POST['email'];

    $query = "SELECT * FROM User 
                    WHERE Email = '$email'";
    $results = $db->query($query);

if ($results->fetchArray()[0] !== null) //checks if rows exist
    {
        // user was found
        $error = false;
        $userinfo = $results->fetchArray(SQLITE3_NUM);
    }
    else
    {
        // user was not found
        $error = true;
    }

    ?>