<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="secure_app.css">
    <meta charset="utf-8" />
    <title>Secure App - User Search</title>
    <?php
    /*Ensure the database was initialized and obtain db link*/
    include_once '../config/ConfigV2.php';

    /*Get information from the post request*/

    $email = strtolower($_POST['email']);

    $query = "SELECT * FROM User WHERE Email = '$email'";
    $results = $db->query($query);

    if($results !== false) //query failed
    {
        if (($results->fetchArray()[0]) !== null) //checks if rows exist
        {
            // user was found
            $error = false;
            $userinfo = $results->fetchArray(SQLITE3_NUM);
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
            <button class="button_large" type="button" onclick=" location.href = 'index.php'">Log Out</button>
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
                echo "An errror has occurred finding user";
                echo $email;
            }
        ?>

        <br><br>

        <div style="text-align:center">
            <div class = "edit_acc_pane">
                <form action="" method="POST">
                    <label class="edit_acc_label">Account type:</label>
                    <select name="" id="acctype">
                        <option value="faculty">Faculty</option>
                        <option value="student">Student</option>
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
                                <input type="text" id="fname">
                            </td>

                            <!--Last Name-->
                            <td>
                                <label class = "edit_acc_label"> Last Name: </label>
                            </td>
                            <td>
                                <input type="text" id="lname">
                            </td>
                        </tr>

                        <tr>
                            <!--Date of Birth-->
                            <td>
                                <label class = "edit_acc_label"> Date of Birth: </label>
                            </td>
                            <td>
                                <input type="date" id="dob">
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
                                <label class = "edit_acc_label"> Rank/Year: </label>
                            </td>
                            <td>
                                <select name="" id="studentyear" style = "display:none">
                                    <optgroup label="Student">
                                        <option value="freshman">Freshman</option>
                                        <option value="sophomore">Sophomore</option>
                                        <option value="junior">Junior</option>
                                        <option value="senior">Senior</option>
                                    </optgroup>
                                </select>
                                <select name="" id="facultyrank">
                                    <optgroup label="Faculty">
                                        <option value="instructor">Instructor</option>
                                        <option value="adjunct">Adjunct Professor</option>
                                        <option value="assistant">Assistant Professor</option>
                                        <option value="associate">Associate Professor</option>
                                        <option value="professor">Professor</option>
                                        <option value="emeritus">Professor Emeritus</option>
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
                                <input type="text">
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
                                <input type="text">
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
                                <input type="text">
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
                                <input type="text">
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
                                <input type="text">
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
                                <input type="text">
                            </td>

                            <!--Blank-->
                            <td>
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
                <input type="submit" value="Submit">&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="button" value="Cancel">
            </div>
        </div>
    </main>

</div>
</body>

<script>

</script>

</html>
