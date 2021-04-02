<?php
try {
//ensuring database connection
    $GLOBALS['dbPath'] = '../db/persistentconndb.sqlite';
    $db = new SQLite3($GLOBALS['dbPath'], $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE, $encryptionKey = "");

//Variables and Email gained from user entry------------------
    $NewPassword = $_POST["newpassword"];
    $NewPasswordConfirm = $_POST["confirmpassword"];

    $filename = "../resources/tmp.txt";
    $file = fopen($filename, "a+");
    $filesize = filesize($filename);
    $email = fread($file, $filesize);
if($NewPassword==null)
{throw new Exception("input did not exist");}

    if ($NewPassword == $NewPasswordConfirm) {
        $query = "UPDATE User SET Password='$NewPassword' WHERE Email ='$email'";
        $results = $db->exec($query);

        //backup database
        $db->backup($db, "temp", $GLOBALS['dbPath']);

        header("Location: ../public/index.php");
    } else {
        header("Location: ../public/ForgotPasswordChange.php?passwordcheck=fail");
    }
}
catch(Exception $e)
{
    echo 'Caught exception: ',  $e->getMessage(), "<br>";
    var_dump($e->getTraceAsString());
    echo 'in '.'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
}
