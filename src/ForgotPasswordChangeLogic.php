<?php
//ensuring database connection
    include_once '../config/ConfigV2.php';

//Variables and Email gained from user entry------------------

$email = strtolower($_POST['Email']);
//$SecQuestion = ($_POST['secQuestion']);
//$SecAnswer = ($_POST['secAnswer']);
//$mySAnswer = ($_POST['secAnswer']);
$NewPassword = "";
$NewPasswordConfirm = "";



if($NewPassword == $NewPasswordConfirm)
{
$query = "UPDATE User SET Password=".$NewPassword." WHERE Email ='$email'";
    $db->exec($query);
header("Location: ../public/index.php");
}

else	
{

header("Location: ../public/ForgotPasswordChange.php?passwordcheck=fail");
}	
     
?>