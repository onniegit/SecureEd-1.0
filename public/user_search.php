<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="secure_app.css">
    <meta charset="utf-8" />
    <title>Secure App - User Search</title>

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
        <h1>User Search</h1>
        <div class=horizontal_line>
            <hr>
        </div>

        <br><br>

        <div style="text-align:center">
            <div class = "search_pane">
                <h1>Search Filters:</h1>
                <div class=horizontal_line>
                    <hr>
                </div>
                <!--Search filters-->

                <form action="" method="post" onsubmit="return fetch();" id="searchform">
                    <table>
                    <tbody>
                    <tr>
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

                        <td class="search_filter">
                            <label class="search_filter" id="positionlabel">
                                Rank:
                            </label>
                        </td>

                        <td class="search_filter_input">
                            <input type="text" name="facultyrank" id="position">
                        </td>
                    </tr>

                    <tr>
                        <td class="search_filter">
                            <label class="search_filter">
                                First Name:
                            </label>
                        </td>
                        <td class="search_filter_input">
                            <input type="text" id="fname"/>
                        </td>

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
                        <td class="search_filter">
                            <label class="search_filter">
                                Email
                            </label>
                        </td>
                        <td class="search_filter_input"> <input type="email" name="email" id="email"> </td>

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
            <br>
            <div style="text-align: left;">

            </div>
            <br><br><br>

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
                            </td>
                        </tr>
                        </thead>

                    </table>

                        <div id="results"></div>





            </div>
        </div>

        <script src="../resources/usersearchdisplay.js"></script>
        <script>
            function swapsearch()
            {
                var acctype = document.getElementById("acctype");
                var positionlabel = document.getElementById("positionlabel");
                var position = document.getElementById("position");

                //change search depending on student of faculty
                if(acctype.options[acctype.selectedIndex].text === "Faculty")
                {
                    positionlabel.innerText = "Rank:";
                    position.name = "facultyrank"; //sends rank to the usersearchdisplay
                }
                else
                {
                    positionlabel.innerText = "Year:";
                    position.name = "studentyear"; //sends year to the usersearchdisplay
                }
            }

            function swaptablesubmit()
            {
                var acctype = document.getElementById("acctype");
                var positionresults = document.getElementById("positionresults");

                //change table header depending on student of faculty
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

    </main>

</div>
</body>
</html>
