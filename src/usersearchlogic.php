<?php
    /*Ensure the database was initialized and obtain db link*/
    $GLOBALS['dbPath'] = '../db/persistentconndb.sqlite';
    $db = new SQLite3($GLOBALS['dbPath'],  $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE , $encryptionKey = "");

    /*Get information from the search (post) request*/
    $acctype = $_POST['acctype'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $studentyear = $_POST['studentyear']; //currently undefined
    $facultyrank = $_POST['facultyrank']; //currently undefined

    //determine account type
    if($acctype == "Student")
    {
        //send back student type search results
        $query = "SELECT * FROM User 
                    WHERE AccountType='Student' 
                       AND (Fname LIKE '$fname'
                       OR Lname LIKE '$lname'
                       OR DOB LIKE '$dob'
                       OR Email LIKE '$email'
                       OR Year LIKE '$studentyear')";
        $results = $db->query($query);
    }
    else if($acctype == "Faculty")
    {
        //send back faculty type search results
        $query = "SELECT * FROM User 
                    WHERE AccountType='Faculty' 
                       AND (Fname LIKE '$fname'
                       OR Lname LIKE '$lname'
                       OR DOB LIKE '$dob'
                       OR Email LIKE '$email'
                       OR Rank LIKE '$facultyrank')";
        $results = $db->query($query);
    }
    else
    {
        //send back a general search (may change to exclude admins)
        $query = "SELECT * FROM User 
                    WHERE Fname LIKE '$fname'
                       OR Lname LIKE '$lname'
                       OR DOB LIKE '$dob'
                       OR Email LIKE '$email'
                       OR Rank LIKE '$facultyrank'";
        $results = $db->query($query);
    }

while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    $jsonArray[] = $row;
}

echo json_encode($jsonArray);

//note: since no changes happen to the database, it is not backed up on this page
?>