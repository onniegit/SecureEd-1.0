<?php
	/*Ensure the database was initialized*/
    include_once '../config/config.php';

	/*Get information from the post request*/
    $myusername = $_POST['username'];
    $mypassword = $_POST['password'];


	/* I currently don't know what this does*/
    $myusername = stripslashes($myusername);
    $mypassword = stripslashes ($mypassword);

    $query = "SELECT COUNT(*) as count FROM USER WHERE USERNAME='$myusername' AND PASSWORD='$mypassword'";
    $count = $db->querySingle($query);

    include '../public/index.php';


    if($count==1)
	{
		echo 'login success';
		global $loginfailed;
        $loginfailed = false;

		header("Location: ../public/index.php", $loginfailed);
    }
	else
	{
		echo 'login fail';
		global $loginfailed;
        $loginfailed = true;
        header("Location: ../public/index.php?login=fail", $loginfailed);
	}

?>