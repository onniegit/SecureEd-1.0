<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../resources/secure_app.css">
    <link rel="icon" type="image/svg" href="../resources/Header_Lock_Image.svg">
    <meta charset="utf-8" />
    <title>Secure ED. - Login</title>
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
		<h1>Log In</h1>
		<div class=horizontal_line>
			<hr>
		</div>
        <br><br>

        <div style="text-align:center">
            <div class = "login">
                <?php
                $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                if ("login=fail" == parse_url($url, PHP_URL_QUERY))
                {
                    echo "The username/password is invalid.";
                }
                ?>
                <form action="../src/Login.php" method="POST">
                    <label style="float: left" for="username">Username:&nbsp;&nbsp;</label>
                    <input type="text" id="username" name="username"><br><br>
                    <label style="float: left" for="password">Password:&nbsp;&nbsp;</label>
                    <input type="password" id="password" name="password" ><br><br>
                    <span style="float: left"><a href="ForgotPassword.php">[Forgot password?]</a></span>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
    </main>

  </div>
</body>
</html>
