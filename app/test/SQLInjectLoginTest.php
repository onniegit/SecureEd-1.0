<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../resources/secure_app.css">
    <link rel="icon" type="image/svg" href="../resources/Header_Lock_Image.svg">
    <script async src="../resources/nav.js"></script>
    <meta charset="utf-8" />
    <title>Secure ED. Tests - SQL Injection Login Test</title>
</head>

<body>
    <div id="wrapper">
        <header>
            <table class="header_table">
                <tbody>
                <tr>
                    <td class="lock"><img src="../resources/Header_Lock_Image.svg" style="width:9vh;" alt="Header_lock"></td>
                    <td class="title"><b>Secure ED. Tests</b></td>
                    <td class="header_table_cell"></td>
                </tr>
                </tbody>
            </table>
        </header>

        <!--Navigation Buttons-->
        <nav>
            <button class="button_large" type="button" onclick="toIndex();">Exit Tests</button>
        </nav>

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
                    <form action="../src/Login.php" method="POST">
                        <label style="float: left" for="username">Username:&nbsp;&nbsp;</label>
                        <input type="text" id="username" name="username" value="admin@email.com'--"><br><br>
                        <label style="float: left" for="password">Password:&nbsp;&nbsp;</label>
                        <input type="password" id="password" name="password"><br><br>
                        <input type="submit" value="Submit">
                    </form>
                </div>
                <div id="injection">
                    <p>Statement to execute: </p>
                    <p>Select * FROM User WHERE Email='student@email.com'–- AND (Password='hash( )' OR Password=' ')</p>
                    <p>Intended result: Ignores AND (Password='hash( )' OR Password=' ') because -- is a comment </p>
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

            //Change the info on screen according to the selected option
            if(sqlinject.options[sqlinject.selectedIndex].text === "Ignore password")
            {
                injectiondiv.innerHTML = "<p>Statement to execute: </p>" +
                    " <p>Select * FROM User WHERE Email='student@email.com'–- AND (Password='hash( )' OR Password=' ')</p>" +
                    "<p>Intended result: Ignores AND (Password='hash( )' OR Password=' ') because -- is a comment </p>" +
                    "<p>Actual result: Same as intended </p>";
                usernamefield.value = "student@email.com'--";
            }
            else if(sqlinject.options[sqlinject.selectedIndex].text === "Delete user table")
            {
                //"SELECT * FROM User WHERE Email='$myusername' AND (Password='$mypassword' OR Password='$hashpassword')"
                injectiondiv.innerHTML = "<p>Statement to execute: </p> " +
                    "<p>Select * FROM User WHERE Email='student@email.com' AND (Password= 'hash(Password3'; DROP TABLE User;)' OR Password='Password3'; DROP TABLE User;')</p>" +
                    "<p>Intended result: Drops the User table after logging in. </p>" +
                    "<p>Actual result: Fails to log in and does not drop the user table. Since passwords are hashed, it would need to be the hash of Password3 to log in. The user table still would not drop as the query function does not support batch instructions.</p>";
                usernamefield.value = "student@email.com";
                passwordfield.value = "Password3'; DROP TABLE User;";
            }
            else if(sqlinject.options[sqlinject.selectedIndex].text === "No credentials")
            {
                injectiondiv.innerHTML = "<p>Statement to execute: </p> " +
                    "<p>Select * FROM User WHERE Email='student@email.com' OR 1=1;-- AND (Password='hash( )' OR Password=' ';)</p>" +
                    "<p>Intended result: Logs in as the first user (Admin) </p>" +
                    "<p>Actual result: Same as intended</p>";
                usernamefield.value = "student@email.com' OR 1=1;--";
            }
        }
    </script>
</body>
</html>