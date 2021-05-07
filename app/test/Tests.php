<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../resources/secure_app.css">
    <link rel="icon" type="image/svg" href="../resources/Header_Lock_Image.svg">
    <script async src="../resources/nav.js"></script>
    <meta charset="utf-8" />
    <title>Secure ED. Tests - Tests</title>
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
            <h1>Tests</h1>
            <div class=horizontal_line>
                <hr>
            </div>
            <button class="button_large" style= "display: block; margin: 6px;" type="button" onclick=" location.href = '../test/CSRFTest.php'">Cross Site Request Forgery</button>
            <button class="button_large" style= "display: block; margin: 6px;" type="button" onclick=" location.href = '../test/SQLInjectLoginTest.php'">Login SQL Injection</button>
            <button class="button_large" style= "display: block; margin: 6px;" type="button" onclick=" location.href = '../test/SQLInjectFPTest.php'">Forgot Password SQL Injection</button>
            <button class="button_large" style= "display: block; margin: 6px;" type="button" onclick=" location.href = '../test/DBcontents.php'">Database Contents</button>
        </main>
    </div>
</body>
