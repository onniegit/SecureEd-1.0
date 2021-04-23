<?php
try {
    /*Get DB connection*/
    require_once "../src/DBController.php";

    /*Get information from the search (post) request*/
    $acctype = $_POST['acctype'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $studentyear = $_POST['studentyear'];
    $facultyrank = $_POST['facultyrank'];

    if($acctype==null)
    {throw new Exception("input did not exist");}

    //handle blank values
    if ($fname === "") {
        $fname = "defaultvalue!";
    }
    if ($lname === "") {
        $lname = "defaultvalue!";
    }
    if ($dob === "") {
        $dob = "defaultvalue!";
    }
    if ($email === "") {
        $email = "defaultvalue!";
    }
    if ($studentyear === "") {
        $studentyear = "defaultvalue!";
    }
    if ($facultyrank === "") {
        $facultyrank = "defaultvalue!";
    }


    //determine account type
    if ($acctype == "Student") {
        //send back student type search results

        $query = "SELECT * FROM User WHERE AccType=3 AND 
            (Fname LIKE :fname OR :fname = 'defaultvalue!') AND
            (Lname LIKE :lname OR :lname = 'defaultvalue!') AND
            (DOB LIKE :dob OR :dob = 'defaultvalue!') AND
            (Email LIKE :email OR :email = 'defaultvalue!') AND
            (Year LIKE :studentyear OR :studentyear = 'defaultvalue!')";
        $stmt = $db->prepare($query); //prevents SQL injection by escaping SQLite characters
        $stmt->bindParam(':studentyear', $studentyear, SQLITE3_INTEGER);
        $stmt->bindParam(':fname', $fname, SQLITE3_TEXT);
        $stmt->bindParam(':lname', $lname, SQLITE3_TEXT);
        $stmt->bindParam(':dob', $dob, SQLITE3_TEXT);
        $stmt->bindParam(':email', $email, SQLITE3_TEXT);
        $results = $stmt->execute();
    }
    else if ($acctype == "Faculty") {
        //send back faculty type search results

        $query = "SELECT * FROM User WHERE AccType=2 AND 
            (Fname LIKE :fname OR :fname = 'defaultvalue!') AND
            (Lname LIKE :lname OR :lname = 'defaultvalue!') AND
            (DOB LIKE :dob OR :dob = 'defaultvalue!') AND
            (Email LIKE :email OR :email = 'defaultvalue!') AND
            (Rank LIKE :facultyrank OR :facultyrank = 'defaultvalue!')";
        $stmt = $db->prepare($query); //prevents SQL injection by escaping SQLite characters
        $stmt->bindParam(':facultyrank', $facultyrank, SQLITE3_TEXT);
        $stmt->bindParam(':fname', $fname, SQLITE3_TEXT);
        $stmt->bindParam(':lname', $lname, SQLITE3_TEXT);
        $stmt->bindParam(':dob', $dob, SQLITE3_TEXT);
        $stmt->bindParam(':email', $email, SQLITE3_TEXT);
        $results = $stmt->execute();
    }
    else {
        //send back a general search (may change to exclude admins)

        $query = "SELECT * FROM User WHERE
            (Fname LIKE :fname OR :fname = 'defaultvalue!') AND
            (Lname LIKE :lname OR :lname = 'defaultvalue!') AND
            (DOB LIKE :dob OR :dob = 'defaultvalue!') AND
            (Email LIKE :email OR :email = 'defaultvalue!') AND
            (Rank LIKE :facultyrank OR :facultyrank = 'defaultvalue!')";
        $stmt = $db->prepare($query); //prevents SQL injection by escaping SQLite characters
        $stmt->bindParam(':fname', $fname, SQLITE3_TEXT);
        $stmt->bindParam(':lname', $lname, SQLITE3_TEXT);
        $stmt->bindParam(':dob', $dob, SQLITE3_TEXT);
        $stmt->bindParam(':email', $email, SQLITE3_TEXT);
        $stmt->bindParam(':facultyrank', $facultyrank, SQLITE3_TEXT);
        $results = $stmt->execute();
    }

    global $jsonArray;

    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
        $jsonArray[] = $row;
    }

    echo json_encode($jsonArray);
}
catch(Exception $e)
{
    //prepare page for content
    include_once "ErrorHeader.php";

    //Display error information
    echo 'Caught exception: ',  $e->getMessage(), "<br>";
    var_dump($e->getTraceAsString());
    echo 'in '.'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']."<br>";

    $allVars = get_defined_vars();
    debug_zval_dump($allVars);
}


//note: since no changes happen to the database, it is not backed up on this page
?>