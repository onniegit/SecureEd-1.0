<?php
/*Ensure the database was initialized and obtain db link*/
$GLOBALS['dbPath'] = '../db/persistentconndb.sqlite';
$db = new SQLite3($GLOBALS['dbPath'],  $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE , $encryptionKey = "");


/*Get information from the post request*/

$prevemail = strtolower($_POST['email']);

$query = "SELECT * FROM User WHERE Email = '$prevemail'";
$results = $db->query($query);

if($results !== false) //check if query failed
{
    if (($userinfo = $results->fetchArray()) !== null) //checks if rows exist
    {
        // user was found
        $error = false;
        //$userinfo = $results->fetchArray();
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
    <link rel="stylesheet" href="secure_app.css">
    <meta charset="utf-8" />
    <title>Secure App - Edit Account</title>

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
            <button class="button_large" type="button" onclick=" location.href = '../src.logout.php'">Log Out</button>
        </nav>

        <br>

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
                <form action="../src/EditAccountUpdateLogic.php" method="POST" id="editform">
                    <label class="edit_acc_label">Account type:</label>
                    <select name="acctype" id="acctype" onchange="swapselection()">
                        <option value="Faculty" <?php if($userinfo[1]==="Faculty"){echo "selected";} ?> ">Faculty</option>
                        <option value="Student" <?php if($userinfo[1]==="Student"){echo "selected";} ?> ">Student</option>
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
                                <input type="text" id="fname" name="fname" value="<?php if(!$error){echo "$userinfo[3]";} ?>">
                            </td>

                            <!--Last Name-->
                            <td>
                                <label class = "edit_acc_label"> Last Name: </label>
                            </td>
                            <td>
                                <input type="text" id="lname" name="lname" value="<?php if(!$error){echo "$userinfo[4]";} ?>">
                            </td>
                        </tr>

                        <tr>
                            <!--Date of Birth-->
                            <td>
                                <label class = "edit_acc_label"> Date of Birth: </label>
                            </td>
                            <td>
                                <input type="date" id="dob" name="dob" value="<?php if(!$error){echo $userinfo[5];} ?>">
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
                                <label class = "edit_acc_label" id="positionlabel"> <?php if($userinfo[1]==="Student"){echo "Year:";} else {echo "Rank:";}?> </label>
                            </td>
                            <td>
                                <select name="studentyear" id="studentyear" style = "<?php if($userinfo[1]!=="Student"){echo "display:none";}?>">
                                    <optgroup label="Student">
                                        <option value="1" <?php if($userinfo[6] == 1){echo "selected";} ?>>Freshman</option>
                                        <option value="2" <?php if($userinfo[6] == 2){echo "selected";} ?>>Sophomore</option>
                                        <option value="3" <?php if($userinfo[6] == 3){echo "selected";} ?>>Junior</option>
                                        <option value="4" <?php if($userinfo[6] == 4){echo "selected";} ?>>Senior</option>
                                    </optgroup>
                                </select>
                                <select name="facultyrank" id="facultyrank" style = "<?php if($userinfo[1]!=="Faculty"){echo "display:none";}?>">
                                    <optgroup label="Faculty">
                                        <option value="Instructor" <?php if($userinfo[7] === "Instructor"){echo "selected";} ?>>Instructor</option>
                                        <option value="Adjunct" <?php if($userinfo[7] === "Adjunct"){echo "selected";} ?>>Adjunct Professor</option>
                                        <option value="Assistant" <?php if($userinfo[7] === "Assistant"){echo "selected";} ?>>Assistant Professor</option>
                                        <option value="Associate" <?php if($userinfo[7] === "Associate"){echo "selected";} ?>>Associate Professor</option>
                                        <option value="Professor" <?php if($userinfo[7] === "Professor"){echo "selected";} ?>>Professor</option>
                                        <option value="Emeritus" <?php if($userinfo[7] === "Emeritus"){echo "selected";} ?>>Professor Emeritus</option>
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
                                <input type="email" name="email" id="email" value="<?php if(!$error){echo "$userinfo[0]";} ?>">
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
                                <input type="email" name="confirmemail" id="confirmemail" value="<?php if(!$error){echo $userinfo[0];} ?>">
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
                                <input type="password" name="password" id="password" value="<?php if(!$error){echo "$userinfo[2]";} ?>">
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
                                <input type="password" name="confirmpassword" id="confirmpassword" value="<?php if(!$error){echo "$userinfo[2]";} ?>">
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
                                <input type="text" name="squestion" value="<?php if(!$error){echo "$userinfo[8]";} ?>">
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
                                <input type="text" name="sanswer" value="<?php if(!$error){echo "$userinfo[9]";} ?>">
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
            <br>
            <div style="text-align: left;">
                <input type="submit" value="Submit" onclick="submitAccount()">&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="button" value="Cancel">
            </div>
        </div>
    </main>

</div>
</body>

<script>
    function swapselection(){
        //get elements from page
        var studentselect = document.getElementById("studentyear");
        var facultyselect = document.getElementById("facultyrank");
        var acctype = document.getElementById("acctype");
        var positionlabel = document.getElementById("positionlabel");

        //change parts of page depending on student of faculty
        if(acctype.options[acctype.selectedIndex].text === "Faculty")
        {
            studentselect.style.display = "none";
            facultyselect.style.display = "inline";
            positionlabel.innerText = "Rank:";
        }
        else
        {
            studentselect.style.display = "inline";
            facultyselect.style.display = "none";
            positionlabel.innerText = "Year:";
        }

    }

    function submitAccount() {
        //get elements from page
        var pass = document.getElementById("password");
        var confirmpass = document.getElementById("confirmpassword");
        var email = document.getElementById("email");
        var confirmemail = document.getElementById("confirmemail");
        var submiterror = document.getElementById("submiterror");
        var editform = document.getElementById("editform");
        var cansubmit = true;

        try
        {
            while (submiterror.removeChild(submiterror.childNodes[0]) !== null)
            {
                //tries to remove all previous error messages if they exist
            }
        }
        catch
        {
            //succeeds when it throws exception
        }

        //reset the element for errors to a default state
        submiterror.innerText = "";
        submiterror.style.display = "none";

        //check if pass is empty
        if(pass.value === "")
        {
            cansubmit = false;
            submiterror.innerText = "Password is empty. \n";
            submiterror.style.display = "block";
        }
        //check if pass and confirm pass are not the same
        if (pass.value !== confirmpass.value)
        {
            cansubmit = false;
            submiterror.innerText = submiterror.innerText.concat("Password and Confirm Password are not the same. \n");
            submiterror.style.display = "block";
        }
        //check if email is empty
        if(email.value === "")
        {
            cansubmit = false;
            submiterror.innerText = submiterror.innerText.concat("Email is empty. \n");
            submiterror.style.display = "block";
        }
        //check if email and confirmemail are not the same
        if (email.value !== confirmemail.value)
        {
            cansubmit = false;
            submiterror.innerText = submiterror.innerText.concat("Email and Confirm Email are not the same. \n");
            submiterror.style.display = "block";
        }
        if(cansubmit)
        {
            editform.submit();
        }
    }

</script>

</html>
