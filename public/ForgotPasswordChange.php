<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="secure_app.css">
    <meta charset="utf-8" />
    <title>Secure App - Forgot Password</title>
</head>
<body>
<div id="wrapper">
    <header>
        <table class="header_table">

            <tbody>
            <tr>

                <td class="lock"><img src="Header_Lock_Image.svg" style="width:9vh;" alt=""></td>

                <td class="title"><b>Secure App</b></td>

                <td class="header_table_cell"></td>

            </tr>
            </tbody>
        </table>
    </header>

    <main>
	<br>

        <!--Heading-->
        <h1>Forgot Password</h1>
        <div class=horizontal_line>
            <hr>
        </div>

<div style="text-align:center">

<div class = "SecurityQuestion">
<?php
                $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                   if("passwordcheck=fail" == parse_url($url, PHP_URL_QUERY))
{
echo "The passwords do not match";
}

?>

<form action="../src/ForgotPasswordChangeLogic.php">
    <label for="newpassword">New Password:&nbsp;&nbsp;</label>
    <input type="password" id="newpassword" name="newpassword"><br><br>
    <label for="confirmpassword">Confirm password:&nbsp;&nbsp;</label>
    <input type="password" id="confirmpassword" name="confirmpassword" ><br><br>
    <input type="submit" value="Submit">
</form>
</div>