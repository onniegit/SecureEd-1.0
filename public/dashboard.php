<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="secure_app.css">
  <meta charset="utf-8" />
  <title>Secure App - Dashboard</title>
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

      <!--Navigation Buttons-->
      <nav>
          <button class="button_large" type="button" onclick=" location.href = 'index.php'">Log Out</button>
      </nav>

    <main>
	<br>
		<h1>Dashboard</h1>
		<div class=horizontal_line>
			<hr>
		</div>
        <div>
            <button class="button_large" type="button">Create Account</button>
        </div>
        <br>
        <button class="button_large" type="button" onclick="location.href = 'user_search.php'">User Search</button>
    </main>

  </div>
</body>
</html>

