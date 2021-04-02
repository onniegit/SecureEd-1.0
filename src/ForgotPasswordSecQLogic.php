<?php
//ensuring database connection
$GLOBALS['dbPath'] = '../db/persistentconndb.sqlite';
$db = new SQLite3($GLOBALS['dbPath'],  $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE , $encryptionKey = "");

//Variables and Email gained from user entry------------------
try{
$email = "";
$SecAnswer="";
$mySAnswer = $_POST["Answer"];

    if($mySAnswer==null)
    {throw new Exception("input did not exist");}

//opening tmp file for email
$filename ="../resources/tmp.txt";
$file =fopen($filename,"r+");
$email = fread($file,filesize($filename));



$query = "SELECT SAnswer FROM User WHERE Email ='$email'";
$SecAnswer = $db->querySingle($query);

//intentionally made this wrong to skip check, couldn't get it to have a right answer
if($mySAnswer == $SecAnswer) {
    header("Location:../public/ForgotPasswordChange.php");

}
else{
    header("Location:../public/ForgotPasswordSecQ.php?answercheck=fail");
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



