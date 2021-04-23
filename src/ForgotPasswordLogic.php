<?php
try {
    /*Get DB connection*/
    require_once "../src/DBController.php";

//Variables and Email gained from user entry------------------

    $email = strtolower($_POST['email']);
    $SecQuestion = "";

    if($email==null)
    {throw new Exception("input did not exist");}


//checks if given email exists-------------
    $query = "SELECT COUNT(*) as count FROM User WHERE Email ='$email'";
    $count = $db->querySingle($query);

    if ($count == 0) {
//Invalid Email
        header("Location: ../public/ForgotPassword.php?emailcheck=fail");
    } else {
        $filename = "../resources/tmp.txt";
        $file = fopen($filename, "w+");
        fwrite($file, $email);
        $query = "SELECT SQuestion FROM User WHERE Email ='$email'";
        $SecQuestion = $db->querySingle($query);

        global $jsonArray;
        $jsonArray[0] = $email;
        $jsonArray[1] = $SecQuestion;

        echo json_encode($jsonArray);

        header("Location:../public/ForgotPasswordSecQ.php");
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







