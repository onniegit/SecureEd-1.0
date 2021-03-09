<?php
	/*Ensure the database was initialized*/
    include_once '../config/configV2.php';

	/*Get information from the post request*/
    $myusername = $_POST['username'];
    $mypassword = $_POST['password'];


    $myusername = strtolower($myusername); //makes username noncase-sensitive

    //query for count
    $query = "SELECT COUNT(*) as count FROM User WHERE Email='$myusername' AND Password='$mypassword'";
    $count = $db->querySingle($query);

    //query for the row(s)
    $query = "SELECT * FROM User WHERE Email='$myusername' AND Password='$mypassword'";
    $results = $db->query($query);

    if($results !== false) //query failed check
    {
        if (($userinfo = $results->fetchArray()) !== null) //checks if rows exist
        {
            // users or user found
            $error = false;
            $acctype = $userinfo[1];
        }
        else
        {
            // user was not found
            $error = true;
        }
    }
    else
    {
        //query failed
        $error = true;
    }

    //determine if an account that met the credentials was found
    if($count==1 && !$error)
    {
        //login success

        if(isset($_SESSION))
        {
            //a session already existed
            session_destroy();
            session_start();
            $_SESSION['email']=$myusername;
            $_SESSION['acctype']=$acctype;
        }
        else
        {
            //a session did not exist
            session_start();
            $_SESSION['email']=$myusername;
            $_SESSION['acctype']=$acctype;
        }
        //redirect
        header("Location: ../public/dashboard.php");
    }
    else
    {
        //login fail
        header("Location: ../public/index.php?login=fail");
    }



?>