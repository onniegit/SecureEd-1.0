<?php
//Access Control

session_start(); //required to bring session variables into context

if (isset($_SESSION['email']) && !empty($_SESSION['email'])) //check that session exists and is nonempty
{
    if (!($_SESSION['acctype'] == 1)) //check if user is not admin
    {
        http_response_code(403);
        die('Forbidden');
    }
}

else
{
    http_response_code(403);
    die('Forbidden');
}

?>

<?php
//This php code gets the selected users info from the database for display

/*Get DB connection*/
require_once "../src/DBController.php";

/*Get information from the post request*/

$prevemail = strtolower($_POST['email']);

$query = "SELECT * FROM User WHERE Email = :prevemail";
$stmt = $db->prepare($query); //prevents SQL injection by escaping SQLite characters
$stmt->bindParam(':prevemail', $prevemail, SQLITE3_TEXT);
$results = $stmt->execute();

if($results !== false) //check if query failed
{
    if (($userinfo = $results->fetchArray()) !== null) //checks if rows exist
    {
        // user was found
        $error = false;
    }
    else
    {
        // user was not found
        $error = true;
    }
}
else
{
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../resources/secure_app.css">
    <link rel="icon" type="image/svg" href="../resources/Header_Lock_Image.svg">
    <script async src="../resources/nav.js"></script>
    <meta charset="utf-8" />
    <title>Secure ED. - Edit Account</title>
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
            <h1>Edit Account</h1>
            <div class=horizontal_line>
                <hr>
            </div>

            <?php
                if ($error)
                {
                    echo "An error has occurred finding user";
                    echo "$prevemail";
                }
                if(!$userinfo)
                {
                    echo "An error has occurred obtaining user info.";
                }
            ?>

            <p id="submiterror" style="display:none"></p>

            <br><br>

            <div style="text-align:center">
                <div class = "edit_acc_pane">
                    <form action="../src/EditAccountUpdateLogic.php" method="POST" id="accform">
                        <label class="edit_acc_label">Account type:</label>
                        <select name="acctype" id="acctype" onchange="swapselection()">
                            <option value="2" <?php if($userinfo[2]===2){echo "selected";} ?> ">Faculty</option>
                            <option value="3" <?php if($userinfo[2]===3){echo "selected";} ?> ">Student</option>
                        </select>
                    <div class=horizontal_line>
                        <hr>
                    </div>
                    <!--Input boxes-->
                        <table>
                            <tbody>
                            <tr>
                                <!--First Name-->
                                <td>
                                    <label class = "edit_acc_label"> First Name: </label>
                                </td>
                                <td>
                                    <input type="text" id="fname" name="fname" value="<?php if(!$error){echo "$userinfo[4]";} ?>">
                                </td>

                                <!--Last Name-->
                                <td>
                                    <label class = "edit_acc_label"> Last Name: </label>
                                </td>
                                <td>
                                    <input type="text" id="lname" name="lname" value="<?php if(!$error){echo "$userinfo[5]";} ?>">
                                </td>
                            </tr>

                            <tr>
                                <!--Date of Birth-->
                                <td>
                                    <label class = "edit_acc_label"> Date of Birth: </label>
                                </td>
                                <td>
                                    <input type="date" id="dob" name="dob" value="<?php if(!$error){echo $userinfo[6];} ?>">
                                </td>

                                <!--Blank-->
                                <td>
                                </td>
                                <td>
                                </td>
                            </tr>

                            <tr>
                                <!--Faculty Rank/Student Year-->
                                <td>
                                    <label class = "edit_acc_label" id="positionlabel"> <?php if($userinfo[2]===3){echo "Year:";} else {echo "Rank:";}?> </label>
                                </td>
                                <td>
                                    <select name="studentyear" id="studentyear" style = "<?php if($userinfo[2]!==3){echo "display:none";}?>">
                                        <optgroup label="Student">
                                            <option value="1" <?php if($userinfo[7] == 1){echo "selected";} ?>>Freshman</option>
                                            <option value="2" <?php if($userinfo[7] == 2){echo "selected";} ?>>Sophomore</option>
                                            <option value="3" <?php if($userinfo[7] == 3){echo "selected";} ?>>Junior</option>
                                            <option value="4" <?php if($userinfo[7] == 4){echo "selected";} ?>>Senior</option>
                                        </optgroup>
                                    </select>
                                    <select name="facultyrank" id="facultyrank" style = "<?php if($userinfo[2]!==2){echo "display:none";}?>">
                                        <optgroup label="Faculty">
                                            <option value="Instructor" <?php if($userinfo[8] === "Instructor"){echo "selected";} ?>>Instructor</option>
                                            <option value="Adjunct" <?php if($userinfo[8] === "Adjunct"){echo "selected";} ?>>Adjunct Professor</option>
                                            <option value="Assistant" <?php if($userinfo[8] === "Assistant"){echo "selected";} ?>>Assistant Professor</option>
                                            <option value="Associate" <?php if($userinfo[8] === "Associate"){echo "selected";} ?>>Associate Professor</option>
                                            <option value="Professor" <?php if($userinfo[8] === "Professor"){echo "selected";} ?>>Professor</option>
                                            <option value="Emeritus" <?php if($userinfo[8] === "Emeritus"){echo "selected";} ?>>Professor Emeritus</option>
                                        </optgroup>
                                    </select>
                                </td>

                                <!--Blank-->
                                <td>
                                </td>
                                <td>
                                </td>
                            </tr>

                            <tr> <!--Blank for spacing-->
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                            </tr>

                            <tr>
                                <!--Email-->
                                <td>
                                    <label class = "edit_acc_label"> Email: </label>
                                </td>
                                <td>
                                    <input type="email" name="email" id="email" value="<?php if(!$error){echo "$userinfo[1]";} ?>">
                                </td>

                                <!--Blank-->
                                <td>
                                </td>
                                <td>
                                </td>
                            </tr>

                            <tr>
                                <!--Confirm Email-->
                                <td>
                                    <label class = "edit_acc_label"> Confirm Email: </label>
                                </td>
                                <td>
                                    <input type="email" name="confirmemail" id="confirmemail" value="<?php if(!$error){echo $userinfo[1];} ?>">
                                </td>

                                <!--Blank-->
                                <td>
                                </td>
                                <td>
                                </td>
                            </tr>

                            <tr>
                                <!--Blank for spacing-->
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                            </tr>

                            <tr>
                                <!--Password-->
                                <td>
                                    <label class = "edit_acc_label"> Password: </label>
                                </td>
                                <td>
                                    <input type="password" name="password" id="password" value="<?php if(!$error){echo "$userinfo[3]";} ?>">
                                </td>

                                <!--Blank-->
                                <td>
                                </td>
                                <td>
                                </td>
                            </tr>

                            <tr>
                                <!--Confirm Password-->
                                <td>
                                    <label class = "edit_acc_label"> Confirm Password: </label>
                                </td>
                                <td>
                                    <input type="password" name="confirmpassword" id="confirmpassword" value="<?php if(!$error){echo "$userinfo[3]";} ?>">
                                </td>

                                <!--Blank-->
                                <td>
                                </td>
                                <td>
                                </td>
                            </tr>

                            <tr>
                                <!--Blank for spacing-->
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                            </tr>

                            <tr>
                                <!--Security question-->
                                <td>
                                    <label class = "edit_acc_label"> Security Question: </label>
                                </td>
                                <td>
                                    <input type="text" name="squestion" value="<?php if(!$error){echo "$userinfo[9]";} ?>">
                                </td>

                                <!--Blank-->
                                <td>
                                </td>
                                <td>
                                </td>
                            </tr>

                            <tr>
                                <!--Answer-->
                                <td>
                                    <label class = "edit_acc_label"> Answer: </label>
                                </td>
                                <td>
                                    <input type="text" name="sanswer" value="<?php if(!$error){echo "$userinfo[10]";} ?>">
                                </td>

                                <!--Blank-->
                                <td>
                                    <input type="hidden" name="prevemail" value="<?php echo "$prevemail" ?>">
                                </td>
                                <td>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>

                <div style="text-align: left;">
                    <input type="submit" value="Submit" onclick="submitAccount()">&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="button" value="Cancel" onclick=" location.href = 'user_search.php'">
                </div>
            </div>
        </main>
    </div>
    <script async src = "../resources/SelectionAndSubmitDisplay.js"></script>
</body>
</html>
