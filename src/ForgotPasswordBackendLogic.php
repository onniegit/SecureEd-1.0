<?php
//ensuring database connection
    include_once '../config/ConfigV2.php';

//Variables and Email gained from user entry------------------

$email = strtolower($_POST['Email']);
$SecQuestion = "";
$SecAnswer = "";
$mySAnswer = "";
$NewPassword = "";
$NewPasswordConfirm = "";

//checks if given email exists-------------
$query = "SELECT COUNT(*) as count FROM User WHERE Email ='$email'";
$count = $db->querySingle($query);

if($count !=1)
{echo 'Invalid Email';}

else	
{	
     //finds security questions and answers of given email---------------
	$query = "SELECT SQuestion FROM User WHERE Email ='$email'";
    	$SecQuestion = $db->query($query);
	
	$query = "SELECT SAnswer FROM User WHERE Email ='$email'";
    	$SecAnswer = $db->query($query);


     //reads answer from user---------------------
	$mySAnswer = $_POST['SAnswer'];

     //checks if anwser is correct---------------
	if($mySAnswer != $SecAnswer)
		{echo 'Invalid Answer';}
	
	else 
		{
		     //reads new password and confirm password---------------
			$NewPassword = $_POST['newpassword'];	
			$NewPasswordConfirm = $_POST['newpasswordconfirm'];
                     
		      //checks if new password matches with confirm password------------
			if($NewPassword != $NewPasswordConfirm)
				{echo 'Passwords do not match';}
			
			else 
				{				      
				      //updates password-----------------
					$query = "UPDATE User SET Password = $NewPassword WHERE Email = '$email'";
					$db->exec($query);
				}

		}
}

?>