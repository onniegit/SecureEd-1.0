<?php
try {
    session_start(); //required to bring session variables into context

    if (isset($_SESSION['acctype'])) {
        //a session exists
        session_destroy(); //clear all session variables
    }
    else{throw new Exception("Session did not exist");}
//redirect
    header("Location: ../public/index.php");
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

?>