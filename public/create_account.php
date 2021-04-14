<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../resources/secure_app.css">
    <meta charset="utf-8" />
    <title>Secure App - Create Account</title>
</head>

<body>
    <div id="wrapper">
        <header>
            <table class="header_table">
                <tbody>
                <tr>
                    <td class="lock"><img src="../resources/Header_Lock_Image.svg" style="width:9vh;" alt="Header_lock"></td>
                    <td class="title"><b>Secure App</b></td>
                    <td class="header_table_cell"></td>
                </tr>
                </tbody>
            </table>
        </header>

        <!--Navigation Buttons-->
        <nav>
            <button class="button_large" type="button" onclick=" location.href = 'dashboard.php'">Dashboard</button>
            <button class="button_large" type="button" onclick=" location.href = '../src/logout.php'">Log Out</button>
        </nav>

        <main>

            <!--Heading-->
            <h1>Create Account</h1>
            <div class="horizontal_line">
                <hr>
            </div>

            <p id="submiterror" style="display:none"></p>

            <div style="text-align:center">
                <div class = "edit_acc_pane">
                    <form action="../src/CreateAccountUpdateLogic.php" method="POST" id="createform">
                        <label class="edit_acc_label">Account type:</label>
                        <select name="acctype" id="acctype" onchange="swapselection()">
                                <optgroup label="Choose one">
                                    <option selected="selected" value="2" >Faculty</option>
                                    <option value="3">Student</option>
                                </optgroup>
                        </select>
                    <div class="horizontal_line">
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
                                    <input type="text" id="fname" name="fname" value="">
                                </td>

                                <!--Last Name-->
                                <td>
                                    <label class = "edit_acc_label"> Last Name: </label>
                                </td>
                                <td>
                                    <input type="text" id="lname" name="lname" value="">
                                </td>
                            </tr>

                            <tr>
                                <!--Date of Birth-->
                                <td>
                                    <label class = "edit_acc_label"> Date of Birth: </label>
                                </td>
                                <td>
                                    <input type="date" id="dob" name="dob" value="">
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
                                    <label class = "edit_acc_label" id="positionlabel"> Rank: </label>
                                </td>
                                <td>
                                    <select name="studentyear" id="studentyear" style = "display:none;">
                                        <optgroup label="Student">
                                            <option selected="selected" value="1" >Freshman</option>
                                            <option value="2" >Sophomore</option>
                                            <option value="3" >Junior</option>
                                            <option value="4" >Senior</option>
                                        </optgroup>
                                    </select>
                                    <select name="facultyrank" id="facultyrank" style = "display:block;">
                                        <optgroup label="Faculty">
                                            <option selected="selected" value="Instructor" >Instructor</option>
                                            <option value="Adjunct" >Adjunct Professor</option>
                                            <option value="Assistant" >Assistant Professor</option>
                                            <option value="Associate" >Associate Professor</option>
                                            <option value="Professor">Professor</option>
                                            <option value="Emeritus">Professor Emeritus</option>
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
                                    <input type="email" name="email" id="email" value="">
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
                                    <input type="email" name="confirmemail" id="confirmemail" value="">
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
                                    <input type="password" name="password" id="password" value="">
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
                                    <input type="password" name="confirmpassword" id="confirmpassword" value="">
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
                                    <input type="text" name="squestion" value="">
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
                                    <input type="text" name="sanswer" value="">
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

                <div style="text-align: left;">
                    <input type="submit" value="Submit" onclick="submitAccount()">&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="button" value="Cancel">
                </div>
            </div>
        </main>
    </div>

<script>
    function swapselection() //changes the value entry based on faculty or student
    {
        //get elements from page
        var studentselect = document.getElementById("studentyear");
        var facultyselect = document.getElementById("facultyrank");
        var acctype = document.getElementById("acctype");
        var positionlabel = document.getElementById("positionlabel");

        //change parts of page depending on student or faculty
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

    function submitAccount() //checks for basic errors when submitting
    {
        //get elements from page
        var pass = document.getElementById("password");
        var confirmpass = document.getElementById("confirmpassword");
        var email = document.getElementById("email");
        var confirmemail = document.getElementById("confirmemail");
        var submiterror = document.getElementById("submiterror");
        var createform = document.getElementById("createform");
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
            createform.submit();
        }
    }

</script>
</body>



</html>