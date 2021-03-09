<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="secure_app.css">
    <meta charset="utf-8" />
    <title>Secure App - Course Search</title>

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
        <h1>Course Search</h1>
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
                                    Semester:
                                </label>
                            </td>

                            <td class="search_filter_input">
                                <input type="text" id ="semester" name="semester">
                            </td>

                            <td class="search_filter">
                                <label class="search_filter">
                                    Department:
                                </label>
                            </td>

                            <td class="search_filter_input">
                                <input type="text" id="department" name="department">
                            </td>
                        </tr>

                        <tr>
                            <td class="search_filter">
                                <label class="search_filter">
                                    Course Name:
                                </label>
                            </td>
                            <td class="search_filter_input">
                                <input type="text" id="coursename" name="coursename"/>
                            </td>

                            <td class="search_filter">
                                <label class="search_filter">
                                    Course ID:
                                </label>
                            </td>
                            <td>
                                <input type="text" id="courseid" name="courseid">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
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

            <div class="course_search_results">
                <h1>Results:</h1>
                <div class="horizontal_line">
                    <hr>
                </div>

                <table class="course_search_table">

                    <thead>

                    <tr>

                        <td class="course_search_results_column_name">
                            <b><u>Course Name</u></b>
                        </td>

                        <td class="course_search_results_column_name">
                            <b><u>Course ID</u></b>
                        </td>

                        <td class="course_search_results_column_name">
                            <b><u>Professor</u></b>
                        </td>

                        <td class="course_search_results_column_name">
                            <b><u>Time</u></b>
                        </td>

                        <td class="course_search_results_column_name">
                            <b><u>Location</u></b>
                        </td>

                        <td class="course_search_results_column_name">
                        </td>
                    </tr>
                    </thead>

                </table>

                <div id="results"></div>





            </div>
        </div>

        <script src="../resources/coursesearchdisplay.js"></script>
    </main>

</div>
</body>
</html>