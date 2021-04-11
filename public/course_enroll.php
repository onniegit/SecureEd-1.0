<?php
//This php code gets all the sections of a given course from course search

/*Ensure the database was initialized and obtain db link*/
$GLOBALS['dbPath'] = '../db/persistentconndb.sqlite';
$db = new SQLite3($GLOBALS['dbPath'],  $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE , $encryptionKey = "");

/*Get information from the post request*/

$coursename = $_POST['coursename'];

global $error;
global $courseArray;

$query = "SELECT *
            FROM Section
            CROSS JOIN Course ON Section.Course = Course.Code
            INNER JOIN User ON Section.Instructor = User.UserID
            WHERE CourseName = '$coursename'";
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
    <meta charset="utf-8" />
    <title>Secure App - Course Enroll</title>
</head>

<body>
    <div id="wrapper">
        <header>
            <table class="header_table">
                <tbody>
                <tr>
                    <td class="lock"><img src="../resources/Header_Lock_Image.svg" style="width:9vh;" alt="eader_lock"></td>
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
            <br>

            <!--Heading-->
            <h1>Course Enroll</h1>
            <div class=horizontal_line>
                <hr>
            </div>

            <div class="course_enroll_results">
                <h1><?php echo "$coursename"; ?></h1>
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
                            $course = $courseArray[$i];
                            $starttimedate = new DateTime('0000-00-00' . $course['StartTime']);
                            $endtimedate = new DateTime('0000-00-00' . $course['EndTime']);
                            $starttime = $starttimedate->format('g:i:A');
                            $endtime = $endtimedate->format('g:i:A');
                            //each loop will get all of the necessary info for each course
                            //this implementation works by knowing how many columns we have
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
