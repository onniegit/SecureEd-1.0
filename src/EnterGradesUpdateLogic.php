<?php
/*Ensure the database was initialized and obtain db link*/
global $db;
$GLOBALS['dbPath'] = '../db/persistentconndb.sqlite';
$db = new SQLite3($GLOBALS['dbPath'],  $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE , $encryptionKey = "");



if(isset($POST['submit']))
{
    if ($_FILES['file']['name'])
    {
        $filename = explode(".", $_FILES['file']['name']);

        if ($filename[1]=='csv')
        {
            $handle = fopen($_FILES['file']['tmp_name'],"r");

            while ($data = fgetcsv($handle))
            {
                $crn = $data[0];
                $student_id = $data[1];
                $grade = $data[2];
                $query = "SELECT StudentID FROM Enrollment WHERE CRN = '$crn'";
                $results = $db->query($query);
                $db->exec("INSERT INTO Grade (CRN, StudentID, Grade) values ('$crn', '$student_id', '$grade')");
            }
            fclose($handle);
            //backup database
            $db->backup($db,"temp","../db/persistentconndb.sqlite");
            echo "Grades have been updated.";
        }
    }
}


    //redirect
    header("Location: ../public/dashboard.php");
