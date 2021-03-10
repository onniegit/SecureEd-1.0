<?php
//ensuring database connection
    include_once '../config/ConfigV2.php';

//Variables and Email gained from user entry------------------
$GLOBALS['email'];
$GLOBALS['SecQuestion'];
Global $email;
Global $SecQuestion;
$SecAnswer;
$mySAnswer = ($_POST['secAnswer']);
//$NewPassword = "";
//$NewPasswordConfirm = "";

$query = "SELECT  SAnswer FROM User WHERE Email ='Global $email'";
 $SecAnswer = $db->query($query);

if($SecAnswer == $mySAnswer)
{

header("Location: ../public/ForgotPasswordChange.php?");
}

else	
{

header("Location: ../public/ForgotPasswordSecQ.php?answercheck=fail");
}	
     
?>