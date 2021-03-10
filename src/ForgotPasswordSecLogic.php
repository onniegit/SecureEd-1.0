<?php
//ensuring database connection
    include_once '../config/ConfigV2.php';

//Variables and Email gained from user entry------------------

$email = strtolower($_POST['Email']);
$SecQuestion = ($_POST['secQuestion']);
$SecAnswer = ($_POST['secAnswer']);
$mySAnswer = ($_POST['secAnswer']);
//$NewPassword = "";
//$NewPasswordConfirm = "";



if($SecAnswer == $mySAnswer)
{

header("Location: ../public/ForgotPasswordChange.php?");
}

else	
{

header("Location: ../public/ForgotPasswordSecQ.php?answercheck=fail");
}	
     
?>