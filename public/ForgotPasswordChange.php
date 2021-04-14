<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../resources/secure_app.css">
    <meta charset="utf-8" />
    <title>Secure App - Forgot Password</title>
</head>

<body>
    <div id="wrapper">
        <header>
            <table class="header_table">
                <tbody>
                <tr>
                    <td class="lock"><img src="../resources/Header_Lock_Image.svg" style="width:9vh;" alt="Header_lock"></td>
                    <td class="title"><b>Secure App</b></td>
                    <td class="header_table_cell"></td>
                </tr>
                </tbody>
            </table>
        </header>

        <main>

            <!--Heading-->
            <h1>Forgot Password</h1>
            <div class=horizontal_line>
                <hr>
            </div>

            <div class = "NewPassword">
                <?php
                         $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                         if("passwordcheck=fail" == parse_url($url, PHP_URL_QUERY))
                         {
                             echo "<p>The passwords did not match.</p>";
                         }
                         else
                         {
                             echo "<p>Please enter your new password below.</p>";
                         }
                ?>


                <form action="../src/ForgotPasswordChangeLogic.php" method="POST">
                    <table>
                        <tr>
                            <td><label for="newpassword">New Password:&nbsp;&nbsp;</label></td>
                            <td><input type="password" id="newpassword" name="newpassword"></td>
                        </tr>
                        <tr>
                            <td><label for="confirmpassword">Confirm password:&nbsp;&nbsp;</label></td>
                            <td><input type="password" id="confirmpassword" name="confirmpassword" ></td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="Submit"></td>
                            <td></td>
                        </tr>
                    </table>
                </form>
            </div>
        </main>
    </div>
</body>