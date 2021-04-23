<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../resources/secure_app.css">
    <link rel="icon" type="image/svg" href="../resources/Header_Lock_Image.svg">
    <meta charset="utf-8" />
    <title>Secure ED. - Forgot Password</title>
</head>

<body>
    <div id="wrapper">
        <header>
            <table class="header_table">
                <tbody>
                <tr>
                    <td class="lock"><img src="../resources/Header_Lock_Image.svg" style="width:9vh;" alt="Header_lock"></td>
                    <td class="title"><b>Secure ED.</b></td>
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

            <div class = "NewPassword" style="text-align:right" >
                <div style="text-align:center">
                <?php
                        //check url if the request failed due to passwords not matching
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
                </div>

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
                    </table>
                    <div style="text-align:center"><input type="submit" value="Submit" ></div>
                </form>
            </div>
        </main>
    </div>
</body>