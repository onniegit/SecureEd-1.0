<?php
//Access Control

session_start(); //required to bring session variables into context

if (!(isset($_SESSION['email']) && !empty($_SESSION['email']))) //check that session exists and is nonempty
{
    http_response_code(403);
    die('Forbidden');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../resources/secure_app.css">
    <link rel="icon" type="image/svg" href="../resources/Header_Lock_Image.svg">
    <script async src="../resources/nav.js"></script>
    <meta charset="utf-8" />
    <title>Secure ED. - Enter Grades</title>
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

        <!--Navigation Buttons-->
        <nav>
            <button class="button_large" type="button" onclick="toDashboard();">Dashboard</button>
            <button class="button_large" type="button" onclick="toLogout();">Log Out</button>
        </nav>

        <main>

            <!--Heading-->
            <h1>Enter Grades</h1>
            <div class="horizontal_line">
                <hr>
            </div>

            <div style="text-align:center">
                <div style="text-align:center;">
                    <form action="../src/EnterGradesUpdateLogic.php" method="POST" enctype="multipart/form-data">
                        <div class="enter_grades_input" style="text-align:left">
                            Course ID: <input type="text" name="crn" id="crn"/>
                            <input type="hidden" name="MAX_FILE_SIZE" value="9437184000" />
                            <input type="file" name="file" id="file"/>



                            <input type="submit" name="submit" id="submit" value="Submit">&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="button" value="Cancel" onclick=" location.href = 'dashboard.php'">

                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>