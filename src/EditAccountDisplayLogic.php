<?php
/*Ensure the database was initialized and obtain db link*/
include_once '../config/ConfigV2.php';

/*Get information from the search (post) request*/

    $email = $_POST['email'];

    $query = "SELECT * FROM User 
                    WHERE Email = '$email')";
    $results = $db->query($query);

    ?>