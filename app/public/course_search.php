<?php
//Access Control

session_start(); //required to bring session variables into context

if (isset($_SESSION['email']) && !empty($_SESSION['email'])) //check that session exists and is nonempty
{
    if (!($_SESSION['acctype'] == 3)) //check if user is not student
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
    <title>Secure ED. - Course Search</title>
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
            <h1>Course Search</h1>
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

                    <form action="" method="post" onsubmit="return fetch();">
                        <table>
                            <tbody>
                            <tr>
                                <!--Semester field-->
                                <td class="search_filter">
                                    <label class="search_filter">
                                        Semester:
                                    </label>
                                </td>

                                <td class="search_filter_input">
                                    <input type="text" id ="semester" name="semester">
                                </td>

                                <!--Department field-->
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
                                <!--Course Name Field-->
                                <td class="search_filter">
                                    <label class="search_filter">
                                        Course Name:
                                    </label>
                                </td>
                                <td class="search_filter_input">
                                    <input type="text" id="coursename" name="coursename"/>
                                </td>

                                <!--Course ID Field-->
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
                <!--End of Search filters-->


                <!--Search results-->
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
                                <b><u>Semester</u></b>
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
            <!--End of Search results-->
        </main>
    </div>
    <script async src="../resources/coursesearchdisplay.js"></script>
</body>
</html>