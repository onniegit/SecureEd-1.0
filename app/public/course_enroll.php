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

<?php
//This php code gets all the sections of a given course from course search

/*Get DB connection*/
require_once "../src/DBController.php";

/*Get information from the post request*/
$coursename = $_POST['coursename'];
$semester = $_POST['semester'];
$year = $_POST['year'];

global $error; //a flag that can be set when an error occurs
global $courseArray; //where course data will be stored from the query

$query = "SELECT *
            FROM Section
            CROSS JOIN Course ON Section.Course = Course.Code
            INNER JOIN User ON Section.Instructor = User.UserID
            WHERE CourseName = '$coursename' AND Semester = '$semester' AND Section.Year = '$year'";
$results = $db->query($query);

global $coursecount; //will track number of courses found
$coursecount = 0;

if($results !== false) //check if query failed
{
    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
        $courseArray[] = $row;
        $coursecount++; //count the number of courses the search finds
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
    <title>Secure ED. - Course Enroll</title>
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
            <h1>Course Enroll</h1>
            <div class=horizontal_line>
                <hr>
            </div>

            <div class="course_enroll_results">
                <h1>
                    <?php
                        echo "$coursename " ."(" . "$semester " . "$year" . ")";
                    ?>
                </h1>
                <div class="horizontal_line">
                    <hr>
                </div>

                <table class="course_enroll_table">
                    <thead>
                    <tr>
                        <td class="course_enroll_column_name">
                            <b><u>Course Code</u></b>
                        </td>

                        <td class="course_enroll_column_name">
                            <b><u>Section</u></b>
                        </td>

                        <td class="course_enroll_column_name">
                            <b><u>Professor</u></b>
                        </td>

                        <td class="course_enroll_column_name">
                            <b><u>Time</u></b>
                        </td>

                        <td class="course_enroll_column_name">
                            <b><u>Location</u></b>
                        </td>

                        <td class="course_enroll_column_name">
                        </td>
                    </tr>
                    </thead>
                </table>
                <?php
                //This php displays the courses that were found from a course search enroll button
                    if($error)
                    {
                        echo "An error occurred finding courses.";
                    }
                    else
                    {
                        for($i=0; $i<$coursecount; $i++)
                        {
                            //get the current course
                            $course = $courseArray[$i];
                            //convert time into correct format
                            $starttimedate = new DateTime('0000-00-00' . $course['StartTime']);
                            $endtimedate = new DateTime('0000-00-00' . $course['EndTime']);
                            $starttime = $starttimedate->format('g:i:A');
                            $endtime = $endtimedate->format('g:i:A');
                            //each loop will get all of the necessary info for each course
                            echo "
                                    <form method=\"post\" action=\"../src/CourseEnrollInsertLogic.php\"><table class=\"course_enroll_table\"><tr>
                                             <td class=\"enroll_output\">${course['Code']}</td>
                                             <td class=\"enroll_output\">${course['SectionLetter']}</td>
                                             <td class=\"enroll_output\">${course['Email']}</td>
                                             <td class=\"enroll_output\">${starttime} - ${endtime}</td>
                                             <td class=\"enroll_output\">${course['Location']}</td>
                                             <input type=\"hidden\" value=\"${course['CRN']}\" name='courseid' id='courseid'/>
                                             <td class=\"enroll_output\"><button name=\"Enroll\" id=\"Enroll\" type=\"submit\">Enroll</button></td>
                                             </tr></table></form>";
                        }
                    }
                ?>
            </div>
        </main>
    </div>
</body>
</html>
