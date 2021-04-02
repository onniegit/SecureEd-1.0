<?php
try {
    /*Ensure the database was initialized and obtain db link*/
    $GLOBALS['dbPath'] = '../db/persistentconndb.sqlite';
    $db = new SQLite3($GLOBALS['dbPath'], $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE, $encryptionKey = "");

    /*Get information from the search (post) request*/
    $acctype = $_POST['acctype'];
    $password = $_POST['password'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob']; //date obtained is already UTC
    $email = strtolower($_POST['email']); //is converted to lower
    $studentyear = $_POST['studentyear']; //only if student, ensure null otherwise
    $facultyrank = $_POST['facultyrank']; //only if faculty, ensure null otherwise
    $squestion = $_POST['squestion'];
    $sanswer = $_POST['sanswer'];
    $prevemail = $_POST['prevemail']; //required to find the user being updated

    /*Checking studentyear and facultyrank*/
    if ($acctype === "Student") {
        $facultyrank = null;
    } else if ($acctype === "Faculty") {
        $studentyear = null;
    }


    /*Update the database with the new info*/
    $query = "UPDATE User 
            SET Email = :email, AccType = :acctype, Password = :password, FName = :fname, LName = :lname, DOB = :dob, Year = :studentyear, Rank = :facultyrank, SQuestion = :squestion, SAnswer = :sanswer 
            WHERE Email = :prevemail";
    $stmt = $db->prepare($query); //prevents SQL injection by escaping SQLite characters
    $stmt->bindParam(':email', $email, SQLITE3_TEXT);
    $stmt->bindParam(':acctype', $acctype, SQLITE3_INTEGER);
    $stmt->bindParam(':password', $password, SQLITE3_TEXT);
    $stmt->bindParam(':fname', $fname, SQLITE3_TEXT);
    $stmt->bindParam(':lname', $lname, SQLITE3_TEXT);
    $stmt->bindParam(':dob', $dob, SQLITE3_TEXT);
    $stmt->bindParam(':studentyear', $studentyear, SQLITE3_INTEGER);
    $stmt->bindParam(':facultyrank', $facultyrank, SQLITE3_TEXT);
    $stmt->bindParam(':squestion', $squestion, SQLITE3_TEXT);
    $stmt->bindParam(':sanswer', $sanswer, SQLITE3_TEXT);
    $stmt->bindParam(':prevemail', $prevemail, SQLITE3_TEXT);
    $results = $stmt->execute();

//is true on success and false on failure
    if (!$results) {
        echo "An error occurred.";
    } else {
        //backup database
        $db->backup($db, "temp", $GLOBALS['dbPath']);
        //redirect
        header("Location: ../public/user_search.php");

    }
}
catch(Exception $e)
{
    var_dump($e->getTraceAsString());
}
/*depricated function
function dateToUTC (String $date): ?string //expects dd/mm/yyyy and returns yyyy-mm-dd or null
{
    list($dd,$mm,$yyyy) = explode('/', $date);
    if (!checkdate($mm,$dd,$yyyy)) {
        return null;
    }
    return $utcdate = $yyyy . '-' . $mm . '-' . $dd;
}
*/