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
}

catch(Exception $e)
{
    echo 'Caught exception: ',  $e->getMessage(), "<br>";
    var_dump($e->getTraceAsString());
    echo 'in '.'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']."<br>";

    $allVars = get_defined_vars();
    //print_r($allVars);
    debug_zval_dump($allVars);
}
