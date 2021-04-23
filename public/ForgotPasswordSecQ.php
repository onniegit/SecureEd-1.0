<?php
//This php code gets the selected user's security question from the database

/*Get DB connection*/
require_once "../src/DBController.php";

/*Get the stored email*/
$filename = "../resources/tmp.txt";
$file = fopen($filename, "a+");
$filesize = filesize($filename);
$email = fread($file, $filesize);

/*Get user's security question*/
$query = "SELECT SQuestion FROM User WHERE Email = '$email'";
$secquestion = $db->querySingle($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../resources/secure_app.css">
    <link rel="icon" type="image/svg" href="../resources/Header_Lock_Image.svg">
    <meta charset="utf-8" />
    <title>Secure ED. - Forgot Password</title>
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

        <main>

            <!--Heading-->
            <h1>Forgot Password</h1>
            <div class=horizontal_line>
                <hr>
            </div>


            <div class = "SecurityQuestion" style="text-align:center">
                <p><?php echo $secquestion;?></p>
                <?php
                                $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                   if("answercheck=fail" == parse_url($url, PHP_URL_QUERY))
                            {
                            echo "The answer is invalid";
                            }
                ?>

                <form action="../src/ForgotPasswordSecQLogic.php" method="POST">
                    <label for="Answer">Answer:&nbsp;&nbsp;</label>
                    <input type="text" id="Answer" name="Answer"><br><br>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </main>
    </div>
</body>
</html>