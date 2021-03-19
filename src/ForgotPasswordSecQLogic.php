<?php
//ensuring database connection
$GLOBALS['dbPath'] = '../db/persistentconndb.sqlite';
$db = new SQLite3($GLOBALS['dbPath'],  $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE , $encryptionKey = "");

//Variables and Email gained from user entry------------------

$email = "";
$SecAnswer="";
$mySAnswer = $_POST['Answer'];

//opening tmp file for email
$filename ="../resources/tmp.txt";
$file =fopen($filename,"r+");
$email = fread($file,filesize(filename));
fclose($file);






$query = "SELECT  SAnswer FROM User WHERE Email ='$email'";
$SecAnswer= $db->querySingle($query);
if($mySAnswer == $SecAnswer) {
    header("Location:../public/ForgotPasswordChange.php");
}
else{
    header("Location:../public/ForgotPasswordSecQ.php?answercheck=fail");
}






