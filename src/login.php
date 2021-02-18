<?php
	/*Ensure the database was initialized*/
    include_once '../config/config.php';

	/*Get information from the post request*/
    $myusername = $_POST['username'];
    $mypassword = $_POST['password'];


	/* I currently don't know what this does*/
    $myusername = stripslashes($myusername);
    $mypassword = stripslashes ($mypassword);

    $query = "SELECT * FROM USER WHERE USERNAME='$myusername' AND PASSWORD='$mypassword'";
    $result = $db->exec($query);
    $count = mysql_num_rows($result);

    if($count==1)
	{
		echo'worked';
		$loginfailed = false;
    }
	else
	{
		$loginfailed = true;
	}

?>