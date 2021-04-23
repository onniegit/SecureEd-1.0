<?php
try{
    session_start();

    /*Get DB connection*/
    require_once "../src/DBController.php";

    /*Get information from the search (post) request*/
    $courseid = $_POST['courseid'];
    $email = strtolower($_SESSION['email']);

    if($courseid==null)
    {throw new Exception("input did not exist");}

    /*Obtain UserID from db*/
    $query = "SELECT UserID FROM User WHERE Email = '$email'";
    $userid = $db->querySingle($query);

    /*Enroll user into course*/
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
}

catch(Exception $e)
{
    //prepare page for content
    echo '<!DOCTYPE html>
            <html lang="en">
            <head>
                <link rel="stylesheet" href="../resources/secure_app.css">
                <link rel="icon" type="image/svg" href="../resources/Header_Lock_Image.svg">
                <script async src="../resources/nav.js"></script>
                <meta charset="utf-8" />
                <title>Secure App - Course Enroll</title>
            </head>';

    //Display error information
    echo 'Caught exception: ',  $e->getMessage(), "<br>";
    var_dump($e->getTraceAsString());
    echo 'in '.'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']."<br>";

    $allVars = get_defined_vars();
    debug_zval_dump($allVars);
}
