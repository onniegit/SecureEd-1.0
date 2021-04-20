<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../resources/secure_app.css">
    <meta charset="utf-8" />
    <title>Secure App Tests - Tests</title>
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
            <button class="button_large" style= "display: block; margin: 6px;" type="button" onclick=" location.href = '../test/CSRFTest.php'">Cross Site Request Forgery</button>
            <button class="button_large" style= "display: block; margin: 6px;" type="button" onclick=" location.href = '../test/SQLInjectLoginTest.php'">Login SQL Injection</button>
            <button class="button_large" style= "display: block; margin: 6px;" type="button" onclick=" location.href = '../test/SQLInjectFPTest.php'">Forgot Password SQL Injection</button>
            <button class="button_large" style= "display: block; margin: 6px;" type="button" onclick=" location.href = '../test/DBcontents.php'">Database Contents</button>
        </main>
    </div>
</body>
