<?php
/*Ensure the database was initialized and obtain db link*/
$GLOBALS['dbPath'] = '../db/persistentconndb.sqlite';
$db = new SQLite3($GLOBALS['dbPath'],  $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE , $encryptionKey = "");

/*Get information from the search (post) request*/
$acctype = $_POST['acctype'];
$password = $_POST['password'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$dob = $_POST['dob']; //is already UTC
$email = strtolower($_POST['email']); //is converted to lower
$studentyear = $_POST['studentyear']; //only if student, ensure null otherwise (must be a number)
$facultyrank = $_POST['facultyrank']; //only if faculty, ensure null otherwise
$squestion = $_POST['squestion'];
$sanswer = $_POST['sanswer'];
$prevemail = $_POST['prevemail']; //required to find the user being updated

/*Checking studentyear and facultyrank*/
if($acctype === "Student")
{
    $facultyrank = null;
}
else if($acctype === "Faculty")
{
    $studentyear = null;
}

/*Check if user already exists*/
$query = "SELECT Email FROM User WHERE Email = '$email'";
$results = $db->query($query);

if($results) //user doesn't exist
{
    /*Update the database with the new info*/
    $query = "INSERT INTO User VALUES ('$email', '$acctype', '$password', '$fname', '$lname', '$dob', '$studentyear', '$facultyrank', '$squestion', '$sanswer')";
    $results = $db->query($query);
}

//is true on success and false on failure (can fail in either query)
if(!$results)
{
    echo "An error occurred.";
}
else
{
    //backup database
    $db->backup($GLOBALS['dbPath'], $db, $db);
    //redirect
    header("Location: ../public/dashboard.php");
}

/* depricated function
function dateToUTC (String $date): ?string //expects dd/mm/yyyy and returns yyyy-mm-dd or null
{
    list($dd,$mm,$yyyy) = explode('/', $date);
    if (!checkdate($mm,$dd,$yyyy)) {
        return null;
    }
    return $utcdate = $yyyy . '-' . $mm . '-' . $dd;
}
*/