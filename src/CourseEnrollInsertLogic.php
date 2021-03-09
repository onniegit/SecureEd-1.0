<?php

session_start();

/*Ensure the database was initialized and obtain db link*/
include_once '../config/ConfigV2.php';

/*Get information from the search (post) request*/
$courseid = $_POST['courseid'];
$email = $_SESSION['email'];

$query = "INSERT INTO CourseEnroll
           VALUES ('$courseid','$email')";
$results = $db->query($query);

//is true on success and false on failure
if(!$results)
{
    echo "An error occurred.";
}
else
{
    header("Location: ../public/course_search.php");
}

