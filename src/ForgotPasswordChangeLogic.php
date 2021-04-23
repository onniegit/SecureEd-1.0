<?php
try {
    /*Get DB connection*/
    require_once "../src/DBController.php";

    //Variables and Email gained from user entry------------------
    $NewPassword = $_POST["newpassword"];
    $NewPasswordConfirm = $_POST["confirmpassword"];

    //Hash new password as 80 byte hash using ripemd256 before changing
    $HashedNewPass = hash('ripemd256', $NewPassword);

    $filename = "../resources/tmp.txt";
    $file = fopen($filename, "a+");
    $filesize = filesize($filename);
    $email = fread($file, $filesize);

    if($NewPassword==null)
    {throw new Exception("input did not exist");}

        if ($NewPassword == $NewPasswordConfirm)
        {
            $query = "UPDATE User SET Password='$HashedNewPass' WHERE Email ='$email' AND '$NewPassword' = '$NewPasswordConfirm'";
            $results = $db->exec($query);

            //backup database
            $db->backup($db, "temp", $GLOBALS['dbPath']);

            header("Location: ../public/index.php");
        }
        else
        {
            header("Location: ../public/ForgotPasswordChange.php?passwordcheck=fail");
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
