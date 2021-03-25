<?php

session_start();

/*Ensure the database was initialized and obtain db link*/
$GLOBALS['dbPath'] = '../db/persistentconndb.sqlite';
$db = new SQLite3($GLOBALS['dbPath'],  $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE , $encryptionKey = "");


/*Get information from the search (post) request*/
$courseid = $_POST['courseid'];
$email = strtolower($_SESSION['email']);

$query = "SELECT UserID FROM User WHERE Email = '$email'";
$userid = $db->querySingle($query);



$query = "INSERT INTO Enrollment
       		    VALUES ('$courseid','$userid')";
$results = $db->query($query);

//is true on success and false on failure
if(!$results)
{
    //redirect back on error
    header("Location: ../public/course_search.php?already_enrolled=true");
}
else
{
    //backup database
    $db->backup($db, "temp", $GLOBALS['dbPath']);
    //redirect
    header("Location: ../public/course_search.php");
}

