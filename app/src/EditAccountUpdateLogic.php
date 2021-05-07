<?php
try {
    /*Get DB connection*/
    require_once "../src/DBController.php";

    /*Get information from the search (post) request*/
    $acctype = $_POST['acctype'];
    $password = hash('ripemd256', $_POST['password']); //convert password to 80 byte hash using ripemd256 before saving
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob']; //date obtained is already UTC
    $email = strtolower($_POST['email']); //is converted to lower
    $studentyear = $_POST['studentyear']; //only if student, ensure null otherwise
    $facultyrank = $_POST['facultyrank']; //only if faculty, ensure null otherwise
    $squestion = $_POST['squestion'];
    $sanswer = $_POST['sanswer'];
    $prevemail = $_POST['prevemail']; //required to find the user being updated


    if($acctype==null)
    {throw new Exception("input did not exist");}

    /*Checking studentyear and facultyrank*/
    if ($acctype === "3") {
        $facultyrank = null;
    } else if ($acctype === "2") {
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
        throw new Exception("edit failed");
    } else {
        //backup database
        $db->backup($db, "temp", $GLOBALS['dbPath']);
        //redirect
        header("Location: ../public/user_search.php");

    }
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
