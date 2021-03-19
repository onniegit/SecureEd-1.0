<?php
/*Check if DB was initialized and grab link*/
$GLOBALS['dbPath'] = '../db/persistentconndb.sqlite';
$db = new SQLite3($GLOBALS['dbPath'],  $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE , $encryptionKey = "");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="secure_app.css">
    <meta charset="utf-8" />
    <title>Secure App - Create Account</title>

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

    <main>
        <!--Navigation Buttons-->
        <nav>
            <button class="button_large" type="button" onclick=" location.href = 'dashboard.php'">Dashboard</button>
            <button class="button_large" type="button" onclick=" location.href = '../src/logout.php'">Log Out</button>
        </nav>

        <br>



        <!--Heading-->
        <h1>Create Account</h1>
        <div class="horizontal_line">
            <hr>
        </div>

        <p id="submiterror" style="display:none"></p>

        <div style="text-align:center">
            <div style="text-align:center;">
                <form action="../src/EnterGradesUpdateLogic.php" method="POST" enctype="multipart/form-data">
                    <div style="text-align:left"><br>
                        Course ID: <input type="text" id="crn"/><br><br><br>

                        <input type="file" name="file" accept=".csv"/>

                        <br><br><br>

                        <input type="submit" value="Submit">&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="button" value="Cancel">

                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>