<?php
//ensuring database connection
    include_once '../config/ConfigV2.php';

//Variables and Email gained from user entry------------------

Global $email;
//$SecQuestion;
//$SecAnswer;
//$mySAnswer;
$NewPassword = ($_POST['newpassword']);
$NewPasswordConfirm = ($_POST['confirmnewPassword']);

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