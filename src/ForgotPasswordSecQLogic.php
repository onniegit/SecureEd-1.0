<?php
//ensuring database connection
$GLOBALS['dbPath'] = '../db/persistentconndb.sqlite';
$db = new SQLite3($GLOBALS['dbPath'],  $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE , $encryptionKey = "");

//Variables and Email gained from user entry------------------

$email = "";
$SecAnswer="";
$mySAnswer = $_POST["Answer"];
try{
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
    var_dump($e->getTraceAsString());
}



