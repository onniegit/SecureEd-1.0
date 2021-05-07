<?php
/*Get DB connection*/
require_once "../src/DBController.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../resources/secure_app.css">
    <link rel="icon" type="image/svg" href="../resources/Header_Lock_Image.svg">
    <script async src="../resources/nav.js"></script>
    <meta charset="utf-8" />
    <title>Secure ED. Tests - DB Contents</title>
</head>

<body>
    <div id="wrapper">
        <header>
            <table class="header_table">
                <tbody>
                <tr>
                    <td class="lock"><img src="../resources/Header_Lock_Image.svg" style="width:9vh;" alt="Header_lock"></td>
                    <td class="title"><b>Secure ED. Tests</b></td>
                    <td class="header_table_cell"></td>
                </tr>
                </tbody>
            </table>
        </header>

        <!--Navigation Buttons-->
        <nav>
            <button class="button_large" type="button" onclick="toIndex();">Exit Tests</button>
        </nav>

        <main>
            <?php
            //page navigation
            echo '<a href="#usercontents"><button>To User</button></a>
                    <a href="#coursecontents"><button>To Course</button></a>
                    <a href="#sectioncontents"><button>To Section</button></a>
                    <a href="#enrollmentcontents"><button>To Enrollment</button></a>
                    <a href="#gradecontents"><button>To Grade</button></a>
                    <a href="#rolecontents"><button>To Role</button></a>';

            //get user table from db
            $sql =<<<EOF
            Select * From User;
            EOF;
            $ret = $db->query($sql);

            //display user table
            echo "<a id='usercontents' ></a>";
            echo "<h1>User Table Contents</h1>";
            while($row = $ret->fetchArray(SQLITE3_ASSOC) )
            {
                echo "<p> UserID = " . $row['UserID'] . "\n</p>";
                echo "<p>Email = " . $row['Email'] . "\n</p>";
                echo "<p>AccType = " . $row['AccType'] . "\n</p>";
                echo "<p>Password = " . $row['Password'] . "\n</p>";
                echo "<p>Name = " . $row['FName'] . ',' . $row['LName'] . "\n</p>";
                echo "<p>DOB = " . $row['DOB'] . "\n</p>";
                echo "<p>Year = " . $row['Year'] . "\n</p>";
                echo "<p>Rank = " . $row['Rank'] . "\n</p>";
                echo "<p>Security Question = " . $row['SQuestion'] . "\n</p>";
                echo "<p>Security Answer = " . $row['SAnswer'] . "\n</p>";
            }
            echo '<a href="#""><button>Top</button></a>';

            //get Course table from db
            $sql =<<<EOF
            Select * From Course;
            EOF;
            $ret = $db->query($sql);

            //display course table
            echo "<a id='coursecontents'></a>";
            echo "<h1>Course Table Contents</h1>";
            while($row = $ret->fetchArray(SQLITE3_ASSOC) )
            {
                echo "<p>Code = " . $row['Code'] . "\n</p>";
                echo "<p>CourseName = " . $row['CourseName'] . "\n</p>";
            }
            echo '<a href="#""><button>Top</button></a>';

            //get Section table from db
            $sql =<<<EOF
            Select * From Section;
            EOF;
            $ret = $db->query($sql);

            //display Section table
            echo "<a id='sectioncontents'></a>";
            echo "<h1>Section Table Contents</h1>";
            while($row = $ret->fetchArray(SQLITE3_ASSOC) )
            {
                echo "<p>CRN = " . $row['CRN'] . "\n</p>";
                echo "<p>Instructor = " . $row['Instructor'] . "\n</p>";
                echo "<p>Course = " . $row['Course'] . "\n</p>";
                echo "<p>Semester = " . $row['Semester'] . "\n</p>";
                echo "<p>SectionLetter = " . $row['SectionLetter'] . "\n</p>";
                echo "<p>StartTime = " . $row['StartTime'] . "\n</p>";
                echo "<p>EndTime = " . $row['EndTime'] . "\n</p>";
                echo "<p>Year = " . $row['Year'] . "\n</p>";
                echo "<p>Location = " . $row['Location'] . "\n</p>";
            }
            echo '<a href="#""><button>Top</button></a>';

            //get Enrollment table from db
            $sql =<<<EOF
            Select * From Enrollment;
            EOF;
            $ret = $db->query($sql);

            //display Enrollment table
            echo "<a id='enrollmentcontents'></a>";
            echo "<h1>Enrollment Table Contents</h1>";
            while($row = $ret->fetchArray(SQLITE3_ASSOC) )
            {
                echo "<p>CRN = " . $row['CRN'] . "\n</p>";
                echo "<p>StudentID = " . $row['StudentID'] . "\n</p>";
            }
            echo '<a href="#""><button>Top</button></a>';

            //get Grade table from db
            $sql =<<<EOF
            Select * From Grade;
            EOF;
            $ret = $db->query($sql);

            //display Grade table
            echo "<a id='gradecontents'></a>";
            echo "<h1>Grade Table Contents</h1>";
            while($row = $ret->fetchArray(SQLITE3_ASSOC) )
            {
                echo "<p>CRN = " . $row['CRN'] . "\n</p>";
                echo "<p>StudentID = " . $row['StudentID'] . "\n</p>";
                echo "<p>Grade = " . $row['Grade'] . "\n</p>";
            }
            echo '<a href="#""><button>Top</button></a>';

            //get Role table from db
            $sql =<<<EOF
            Select * From Role;
            EOF;
            $ret = $db->query($sql);

            //display Role table
            echo "<a id='rolecontents'></a>";
            echo "<h1>Role Table Contents</h1>";
            while($row = $ret->fetchArray(SQLITE3_ASSOC) )
            {
                echo "<p>Role ID = " . $row['RoleID'] . "\n</p>";
                echo "<p>Role = " . $row['Role'] . "\n</p>";
            }
            echo '<a href="#""><button>Top</button></a>';
            ?>
        </main>
    </div>
</body>
</html>
