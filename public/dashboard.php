<?php
    session_start(); //required to bring session variables into context
?>

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
          <button class="button_large" type="button" onclick=" location.href = '../src/logout.php'">Log Out</button>
      </nav>

      <?php

      if($_SESSION['acctype']==="Admin")
      {
          echo "
            <main>
            <br>
                <h1>Dashboard</h1>
                <div class=horizontal_line>
                    <hr>
                </div>
                <div>
                    <button class=\"button_large\" type=\"button\" onclick=\"location.href = 'create_account.php'\">Create Account</button>
                </div>
                <br>
                <button class=\"button_large\" type=\"button\" onclick=\"location.href = 'user_search.php'\">User Search</button>
            </main>";
      }
      else if($_SESSION['acctype']==="Faculty")
      {
        echo "
           <main>
            <br>
                <h1>Dashboard</h1>
                <div class=horizontal_line>
                    <hr>
                </div>
                <div>
                    <button class=\"button_large\" type=\"button\" onclick=\"location.href = 'enter_grades.php'\">Enter Grades</button>
                </div>
            </main>";
      }
      else if($_SESSION['acctype']==="Student")
      {
          echo "
           <main>
            <br>
                <h1>Dashboard</h1>
                <div class=horizontal_line>
                    <hr>
                </div>
                <div>
                    <button class=\"button_large\" type=\"button\" onclick=\"location.href = 'course_search.php'\">Course Search</button>
                </div>
            </main>";
      }
    ?>

  </div>
</body>
</html>

