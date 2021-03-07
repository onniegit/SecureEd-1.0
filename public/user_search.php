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
            <button class="button_large" type="button" onclick=" location.href = 'index.php'">Log Out</button>
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

                <form action="" method="post" onsubmit="return fetch();">
                    <table>
                    <tbody>
                    <tr>
                        <td class="search_filter">
                            <label class="search_filter">
                                Account type:
                            </label>
                        </td>

                        <td class="search_filter_input">
                            <input type="text" id ="acctype">
                        </td>

                        <td class="search_filter">
                            <label class="search_filter">
                                Position:
                            </label>
                        </td>

                        <td class="search_filter_input">
                            <input type="text">
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
                            <button class="button_large" type="submit">
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
                                <b><u>Position</u></b>
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
    </main>

</div>
</body>
</html>
