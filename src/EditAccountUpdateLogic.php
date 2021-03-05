<?php
/*Ensure the database was initialized and obtain db link*/
include_once '../config/ConfigV2.php';

/*Get information from the search (post) request*/
$acctype = $_POST['acctype'];
$password = $_POST['password'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$dob = dateToUTC($_POST['dob']); //is to converted to UTC
$email = strtolower($_POST['email']); //is converted to lower
$studentyear = $_POST['studentyear']; //only if student, ensure null otherwise
$facultyrank = $_POST['facultyrank']; //only if faculty, ensure null otherwise
$squestion = $_POST['squestion'];
$sanswer = $_POST['sanswer'];

/*Checking studentyear and facultyrank*/
if($acctype == "Student")
{
    $facultyrank = null;
}
else if($acctype == "Faculty")
{
   $studentyear = null;
}

/*Update the database with the new info*/


$query = "UPDATE User SET Email = '$email', AccountType = '$acctype', Password = '$password', 
                FName = '$fname', LName = '$lname, DOB = '$dob', Year = '$studentyear', Rank = '$facultyrank', SQuestion = '$squestion', SAnswer = '$sanswer')";
$results = $db->query($query);

function dateToUTC (String $date): ?string //expects dd/mm/yyyy and returns yyyy-mm-dd or null
{
    list($dd,$mm,$yyyy) = explode('/', $date);
    if (!checkdate($mm,$dd,$yyyy)) {
        return null;
    }
    return $utcdate = $yyyy . '-' . $mm . '-' . $dd;

?>