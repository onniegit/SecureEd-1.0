<?php
/*Ensure the database was initialized and obtain db link*/
include_once '../config/ConfigV2.php';

/*Get information from the search (post) request*/
$acctype = $_POST['acctype'];
$password = $_POST['password'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$dob = $_POST['dob']; //will need to convert this to UTC
$email = $_POST['email']; //will need to convert this to lower
$studentyear = $_POST['studentyear']; //only if student, ensure null otherwise
$facultyrank = $_POST['facultyrank']; //only if faculty, ensure null otherwise
$squestion = $_POST['squestion'];
$sanswer = $_POST['sanswer'];

/*Update the database with the new info*/


$query = "UPDATE User SET Email = '$email', AccountType = '$acctype', Password = '$password', 
                FName = '$fname', LName = '$lname, DOB = '$dob', Year = '$studentyear', Rank = '$facultyrank', SQuestion = '$squestion', SAnswer = '$sanswer')";
$results = $db->query($query);