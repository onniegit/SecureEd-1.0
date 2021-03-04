<?php
/*Ensure the database was initialized and obtain db link*/
include_once '../config/ConfigV2.php';

/*Get information from the post request*/

    $email = $_POST['email'];

    $query = "SELECT * FROM User 
                    WHERE Email = '$email')";
    $results = $db->query($query);

    if ($results->fetchArray()[0] !== null) //checks if rows exist
    {
        // user was found
        $error = false;
        $userinfo = $results->fetchArray(SQLITE3_NUM);
    }
    else
    {
        // user was not found
        $error = true;
    }


    ?>