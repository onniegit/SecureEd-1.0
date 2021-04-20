<?php
/*Get DB connection*/
require_once "../src/DBController.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../resources/secure_app.css">
    <meta charset="utf-8" />
    <title>Secure App Tests - CSRF Test</title>
</head>

<body>
    <div id="wrapper">
        <header>
            <table class="header_table">
                <tbody>
                <tr>
                    <td class="lock"><img src="../resources/Header_Lock_Image.svg" style="width:9vh;" alt="Header_lock"></td>
                    <td class="title"><b>Secure App Tests</b></td>
                    <td class="header_table_cell"></td>
                </tr>
                </tbody>
            </table>
        </header>

        <main>
            <?php
            $sql =<<<EOF
            Select * From User;
            EOF;
            $ret = $db->query($sql);
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

            $sql =<<<EOF
            Select * From Course;
            EOF;
            $ret = $db->query($sql);
            echo "<h1>Course Table Contents</h1>";
            while($row = $ret->fetchArray(SQLITE3_ASSOC) )
            {
                echo "<p>Code = " . $row['Code'] . "\n</p>";
                echo "<p>CourseName = " . $row['CourseName'] . "\n</p>";
            }

            $sql =<<<EOF
            Select * From Section;
            EOF;
            $ret = $db->query($sql);
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

            $sql =<<<EOF
            Select * From Enrollment;
            EOF;
            $ret = $db->query($sql);
            echo "<h1>Enrollment Table Contents</h1>";
            while($row = $ret->fetchArray(SQLITE3_ASSOC) )
            {
                echo "<p>CRN = " . $row['CRN'] . "\n</p>";
                echo "<p>StudentID = " . $row['StudentID'] . "\n</p>";
            }

            $sql =<<<EOF
            Select * From Grade;
            EOF;
            $ret = $db->query($sql);
            echo "<h1>Grade Table Contents</h1>";
            while($row = $ret->fetchArray(SQLITE3_ASSOC) )
            {
                echo "<p>CRN = " . $row['CRN'] . "\n</p>";
                echo "<p>StudentID = " . $row['StudentID'] . "\n</p>";
                echo "<p>Grade = " . $row['Grade'] . "\n</p>";
            }

            $sql =<<<EOF
            Select * From Role;
            EOF;
            $ret = $db->query($sql);
            echo "<h1>Role Table Contents</h1>";
            while($row = $ret->fetchArray(SQLITE3_ASSOC) )
            {
                echo "<p>Role ID = " . $row['RoleID'] . "\n</p>";
                echo "<p>Role = " . $row['Role'] . "\n</p>";
            }
            ?>


        </main>
    </div>
</body>
</html>
