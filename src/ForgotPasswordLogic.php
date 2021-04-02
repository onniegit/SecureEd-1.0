<?php
try {
//ensuring database connection
    $GLOBALS['dbPath'] = '../db/persistentconndb.sqlite';
    $db = new SQLite3($GLOBALS['dbPath'], $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE, $encryptionKey = "");

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
    echo 'Caught exception: ',  $e->getMessage(), "<br>";
    var_dump($e->getTraceAsString());
    echo 'in '.'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
}







