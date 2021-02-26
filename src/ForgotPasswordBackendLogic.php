<?php
//ensuring database connection
    include_once '../config/ConfigV2.php';

//Variables and Email gained from user entry

$email = $_POST['Email'];
$SecQuestion;
$SecAnswer;
$mySAnswer;
$NewPassword;
$NewPasswordConfirm;

$query = "SELECT COUNT(*) as count FROM User WHERE Email ='$email'";
$count = $db->querySingle($query);

if($count==1)
	{
	
	$query = "SELECT SQuestion FROM User WHERE Email ='$email'";
    	SecQuestion = $db->query($query);
	
	$query = "SELECT SAnswer FROM User WHERE Email ='$email'";
	SecAnswer = $db->query($query);

	$mySAnswer = $_POST['SAnswer'];

	
	if($mySAnswer != SecAnswer)
		{echo 'Invalid Answer';}
	else 
		{
			$NewPassword = $_POST['newpassword'];	
			$NewPasswordConfirm = $_POST['newpasswordconfirm'];

			if($NewPassword == NewPasswordConfirm)
				{
					$query = "UPDATE User SET Password = $NewPassword WHERE Email = '$email'";
					$db->exec($query);
				}
			else {echo 'Passwords do not match';}

		}
	
else {echo 'Invalid Email';}

