<?php
/*Get DB connection*/
require_once "../src/DBController.php";


try{
    //Variables and Email gained from user entry
    $email = "";
    $SecAnswer="";
    $mySAnswer = $_POST["Answer"];

    if($mySAnswer==null)
    {throw new Exception("input did not exist");}

    //opening tmp file for email
    $filename ="../resources/tmp.txt";
    $file =fopen($filename,"r+");
    $email = fread($file,filesize($filename));


    //query for searching if a user exists with the entered answer
    $query = "SELECT COUNT(*) as count FROM User as Count WHERE Email ='$email' AND SAnswer = '$mySAnswer'";
    $count = $db->querySingle($query);

    if($count >= 1)
    {
        //SAnswer was correct
        header("Location:../public/ForgotPasswordChange.php");
    }
    else
    {
        //SAnswer was incorrect
        header("Location:../public/ForgotPasswordSecQ.php?answercheck=fail");
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



