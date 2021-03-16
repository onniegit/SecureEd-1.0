<?php

session_start();

/*Ensure the database was initialized and obtain db link*/
$GLOBALS['dbPath'] = '../db/persistentconndb.sqlite';
$db = new SQLite3($GLOBALS['dbPath'],  $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE , $encryptionKey = "");


/*Get information from the search (post) request*/
$courseid = $_POST['courseid'];
$email = $_SESSION['email'];

$query = "INSERT INTO CourseEnroll
           VALUES ('$courseid','$email')";
$results = $db->query($query);

//is true on success and false on failure
if(!$results)
{
    echo "An error occurred.";
}
else
{
    //backup database
    $db->backup($GLOBALS['dbPath'], $db, $db);
    //redirect
    header("Location: ../public/course_search.php");
}

