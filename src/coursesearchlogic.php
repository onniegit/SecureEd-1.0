<?php
    /*Ensure the database was initialized and obtain db link*/
    include_once '../config/ConfigV2.php';

    /*Get information from the search (post) request*/
    $courseid = $_POST['courseid'];
    $coursename = $_POST['coursename'];
    $semester = $_POST['semester'];
    $department = $_POST['department'];

        //search courses
        $query = "SELECT * FROM Course 
                    WHERE CourseID LIKE '$courseid'
                       OR CourseName LIKE '$coursename'
                       OR Semester LIKE '$semester'
                       OR Location LIKE '$department'";
        $results = $db->query($query);


while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    $jsonArray[] = $row;
}

echo json_encode($jsonArray);

?>