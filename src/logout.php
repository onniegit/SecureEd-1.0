<?php
session_start(); //required to bring session variables into context

if(isset($_SESSION['acctype']))
{
    //a session exists
    session_destroy(); //clear all session variables
}
//redirect
header("Location: ../public/index.php");

?>