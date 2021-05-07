<?php
try {
    /*Get DB connection*/
    require_once "../src/DBController.php";

    /*Get information from the search (post) request*/
    $courseid = $_POST['courseid'];
    $coursename = $_POST['coursename'];
    $semester = $_POST['semester'];
    $department = $_POST['department'];

    //set default values if blank
    if($courseid=="")
    {
        $courseid="defaultvalue!";
    }
    if($coursename=="")
    {
        $coursename="defaultvalue!";
    }
    if($semester=="")
    {
        $semester="defaultvalue!";
    }
    if($department=="")
    {
        $department="defaultvalue!";
    }

    $query = "	SELECT Section.CRN, Course.CourseName, Section.Year, Section.Semester, User.Email, Section.Location
            FROM Section
            CROSS JOIN Course ON Section.Course = Course.Code
            INNER JOIN User ON Section.Instructor = User.UserID
            WHERE (CRN LIKE '$courseid' OR '$courseid'='defaultvalue!') AND
                    (Semester LIKE '$semester' OR '$semester'='defaultvalue!') AND
                    (Course LIKE '$department' OR '$department'='defaultvalue!') AND
                    (CourseName LIKE '$coursename' OR '$coursename' = 'defaultvalue!')";

    $results = $db->query($query);

    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
        $jsonArray[] = $row;
    }

    echo json_encode($jsonArray);
//note: since no changes happen to the database, it is not backed up on this page
}

catch(Exception $e)
{
    //prepare page for content
    include_once "ErrorHeader.php";

    //Display error information
    echo 'Caught exception: ',  $e->getMessage(), "<br>";
    var_dump($e->getTraceAsString());
    echo 'in '.'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']."<br>";

    $allVars = get_defined_vars();
    debug_zval_dump($allVars);
}
?>