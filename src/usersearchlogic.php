<?php
    /*Ensure the database was initialized and obtain db link*/
    include_once '../config/ConfigV2.php';

    /*Get information from the search (post) request*/
    $acctype = $_POST['acctype'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $studentyear = $_POST['studentyear'];
    $facultyrank = $_POST['facultyrank'];


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

?>