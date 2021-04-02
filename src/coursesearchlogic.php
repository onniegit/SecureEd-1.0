<?php
try {
    /*Ensure the database was initialized and obtain db link*/
    $GLOBALS['dbPath'] = '../db/persistentconndb.sqlite';
    $db = new SQLite3($GLOBALS['dbPath'], $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE, $encryptionKey = "");

    /*Get information from the search (post) request*/
    $courseid = $_POST['courseid'];
    $coursename = $_POST['coursename'];
    $semester = $_POST['semester'];
    $department = $_POST['department'];

    //search courses
    /*$query = "SELECT * FROM Course
                WHERE CourseID LIKE '$courseid'
                   OR CourseName LIKE '$coursename'
                   OR Semester LIKE '$semester'
                   OR Location LIKE '$department'";
    */
    $query = "	SELECT *
            FROM Section
            CROSS JOIN Course ON Section.Course = Course.Code
            INNER JOIN User ON Section.Instructor = User.UserID
            WHERE CRN LIKE '$courseid' OR Semester LIKE '$semester' OR Course LIKE '$department' OR CourseName LIKE '$coursename'";

    $results = $db->query($query);


    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
        $jsonArray[] = $row;
    }

    echo json_encode($jsonArray);

//note: since no changes happen to the database, it is not backed up on this page
}

catch(Exception $e)
{
    header("Location:../resources/Errorpage.php");
}
?>