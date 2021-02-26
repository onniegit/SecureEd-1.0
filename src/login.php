<?php
	/*Ensure the database was initialized*/
    include_once '../config/ConfigV2.php';

	/*Get information from the post request*/
    $myusername = $_POST['username'];
    $mypassword = $_POST['password'];


	/* I currently don't know what this does*/ 
//I looked it up, all it does is remove backslashes,
//so we dont really need it. -David

   // $myusername = stripslashes($myusername);
   // $mypassword = stripslashes ($mypassword);

    $myusername = strtolower($myusername); //makes username noncase-sensitive

    $query = "SELECT COUNT(*) as count FROM User WHERE Email='$myusername' AND Password='$mypassword'";
    $count = $db->querySingle($query);

    include '../public/index.php';

    //determine if an account that met the credentials was found
    if($count==1)
	{
		echo 'login success';
		header("Location: ../public/dashboard.php");
    }
	else
	{
		echo 'login fail';
        header("Location: ../public/index.php?login=fail");
	}

?>