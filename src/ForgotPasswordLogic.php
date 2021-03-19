<?php
//ensuring database connection
$GLOBALS['dbPath'] = '../db/persistentconndb.sqlite';
$db = new SQLite3($GLOBALS['dbPath'],  $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE , $encryptionKey = "");

//Variables and Email gained from user entry------------------

$email = strtolower($_POST['email']);
$SecQuestion="";
$SecAnswer="";
//$mySAnswer = "";
//$NewPassword = "";
//$NewPasswordConfirm = "";

//checks if given email exists-------------
$query = "SELECT COUNT(*) as count FROM User WHERE Email ='$email'";
$count = $db->querySingle($query);

if($count ==0)
{
//Invalid Email
header("Location: ../public/ForgotPassword.php?emailcheck=fail");
}

else	
{
    $filename ="../resources/tmp.txt";
    $file =fopen($filename,"w+");
    fwrite($file,$email);

    Global $jsonArray;
    $jsonArray[0] = $email;
    $jsonArray[1] = $SecQuestion;

    echo json_encode($jsonArray);

header("Location:../public/ForgotPasswordSecQ.php");
}	







