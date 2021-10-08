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

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../resources/secure_app.css">
    <link rel="icon" type="image/svg" href="../resources/Header_Lock_Image.svg">
    <script async src="../resources/nav.js"></script>
    <meta charset="utf-8" />
    <title>Secure ED. - User Search</title>
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
            <h1>User Search</h1>
            <div class=horizontal_line>
                <hr>
            </div>
            <br><br>

            <!--Search filters-->
            <div style="text-align:center">
                <div class = "search_pane">
                    <h1>Search Filters:</h1>
                    <div class=horizontal_line>
                        <hr>
                    </div>
                    <form action="" method="post" onsubmit="return fetch();" id="searchform">
                        <table>
                        <tbody>
                            <tr>
                                <!--Account type-->
                                <td class="search_filter">
                                    <label class="search_filter">
                                        Account type:
                                    </label>
                                </td>

                                <td class="search_filter_input">
                                    <select name="acctype" id="acctype" onchange="swapsearch()">
                                        <option value="Faculty">Faculty</option>
                                        <option value="Student">Student</option>
                                    </select>
                                </td>

                                <!--Student year or Faculty rank based on account type-->
                                <td class="search_filter">
                                    <label class="search_filter" id="positionlabel">
                                        Rank:
                                    </label>
                                </td>

                                <td class="search_filter_input">
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
                            </tr>

                            <tr>
                                <!--First Name-->
                                <td class="search_filter">
                                    <label class="search_filter">
                                        First Name:
                                    </label>
                                </td>
                                <td class="search_filter_input">
                                    <input type="text" id="fname"/>
                                </td>

                                <!--Last Name-->
                                <td class="search_filter">
                                    <label class="search_filter">
                                        Last Name:
                                    </label>
                                </td>
                                <td>
                                    <input type="text" id="lname" name="lname">
                                </td>
                            </tr>

                            <tr>
                                <!--Date of Birth-->
                                <td class="search_filter">
                                    <label>
                                        Date of Birth:
                                    </label>
                                </td>
                                <td class="search_filter_input">
                                    <input type="date" id="dob" name="dob">
                                </td>

                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <!--Email-->
                                <td class="search_filter">
                                    <label class="search_filter">
                                        Email:
                                    </label>
                                </td>
                                <td class="search_filter_input">
                                    <input type="email" name="email" id="email">
                                </td>

                                <td></td>
                                <td style="text-align: right">
                                    <button class="button_large" type="submit" onclick="swaptablesubmit()">
                                        Search
                                    </button></td>
                            </tr>
                        </tbody>
                        </table>
                    </form>
                </div>
                <!--End of Search filters-->

                <!--Search results-->
                <div class="search_results">
                    <h1>Results:</h1>
                    <div class="horizontal_line">
                        <hr>
                    </div>
                        <table class="search_table">
                            <thead>
                                <tr>
                                    <td class="search_results_column_name">
                                        <b><u>Name</u></b>
                                    </td>

                                    <td class="search_results_column_name">
                                        <b><u>DOB</u></b>
                                    </td>

                                    <td class="search_results_column_name">
                                        <b><u>Email</u></b>
                                    </td>

                                    <td class="search_results_column_name">
                                        <b><u id="positionresults">Rank</u></b>
                                    </td>

                                    <td class="search_results_column_name">
                                        &nbsp; &nbsp; &nbsp;
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    <div id="results"></div>
                </div>
            </div>
            <!--End of Search results-->
        </main>
    </div>
    <script async src="../resources/usersearchdisplay.js"></script>
    <script>
        function swapsearch() //changes the search filter based on faculty or student
        {
            //get variables from the page
            var acctype = document.getElementById("acctype");
            var positionlabel = document.getElementById("positionlabel");
            var studentselect = document.getElementById("studentyear");
            var facultyselect = document.getElementById("facultyrank");

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

        function swaptablesubmit() //changes the search result label based on faculty or student when a search is made
        {
            //get variables from the page
            var acctype = document.getElementById("acctype");
            var positionresults = document.getElementById("positionresults");

            //change table header depending on student or faculty
            if(acctype.options[acctype.selectedIndex].text === "Faculty")
            {
                positionresults.innerText = "Rank";
            }
            else
            {
                positionresults.innerText = "Year";
            }
        }
    </script>
</body>
</html>
