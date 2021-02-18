<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="secure_app.css">
  <meta charset="utf-8" />
  <title>Secure App - Login</title>
</head>
<body>
  <div id="wrapper">
    <header>
	  <table class="headertable">
	    <tbody>
		  <tr>
		  
			<td class="lock"><img src="Header_Lock_Image.svg" style="width:9vh;"></td>
			
			<td class="title"><b>Secure App</b></td>
			
			<td class="headertablecell"></td>

		  </tr>
		</tbody>
	  </table>
    </header>

    <nav>
      <input type="button" value="Forgot Password?">
    </nav>
	
    <main>
	<br>
		<h2>Log In</h2>
		<div class=horizontal_line>
			<hr>
		</div>
		<div class = "login">
			<?php
            $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            if ("login=fail" == parse_url($url, PHP_URL_QUERY))
            {
                echo "The username/password is invalid.";
            }
			?>
			<form action="/src/login.php" method="POST">
				<label for="username">Username:</label>
				<input type="text" id="username" name="username"><br><br>
				<label for="password">Password:</label>
				<input type="password" id="password" name="password" ><br><br>
				<input type="submit" value="Submit">
			</form>
		</div>
    </main>
	
  </div>
</body>
</html>