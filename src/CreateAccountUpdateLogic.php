<?php
/*Ensure the database was initialized and obtain db link*/
include_once '../config/ConfigV2.php';

/*Get information from the search (post) request*/
$acctype = $_POST['acctype'];
$password = $_POST['password'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$dob = dateToUTC($_POST['dob']); //is converted to UTC
$email = strtolower($_POST['email']); //is converted to lower
$studentyear = $_POST['studentyear']; //only if student, ensure null otherwise
$facultyrank = $_POST['facultyrank']; //only if faculty, ensure null otherwise
$squestion = $_POST['squestion'];
$sanswer = $_POST['sanswer'];
$prevemail = $_POST['prevemail']; //required to find the user being updated

/*Checking studentyear and facultyrank*/
if($acctype === "Student")
{
    $facultyrank = null;
}
else if($acctype === "Faculty")
{
    $studentyear = null;
}

/*Update the database with the new info*/
$query = "INSERT INTO User VALUES ('$email', '$acctype', '$password', '$fname', '$lname', '$dob', '$studentyear', '$facultyrank', '$squestion', '$sanswer')";
$results = $db->query($query);

//is true on success and false on failure
if(!$results)
{
    echo "An error occurred.";
}
else
{
    header("Location: ../public/dashboard.php");
}


function dateToUTC (String $date): ?string //expects dd/mm/yyyy and returns yyyy-mm-dd or null
{
    list($dd,$mm,$yyyy) = explode('/', $date);
    if (!checkdate($mm,$dd,$yyyy)) {
        return null;
    }
    return $utcdate = $yyyy . '-' . $mm . '-' . $dd;
}