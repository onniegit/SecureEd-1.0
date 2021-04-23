<?php
try {
    /*Get DB connection*/
    require_once "../src/DBController.php";

    if (isset($_POST['submit'])) { //checks if submit var is set
        $handle = fopen(($_FILES['file']['tmp_name']), "r"); //sets a read-only pointer at beginning of file
        $crn = $_POST['crn']; //grabs CRN from form
        $path = pathinfo($_FILES['file']['name']); //path info for file

        if($path['extension'] == 'csv') { //check if file is .csv
            while (($data = fgetcsv($handle, 9001, ",")) !== FALSE) { //iterate through csv
                $query = "INSERT INTO Grade VALUES (:crn, '$data[0]', '$data[1]')";//create query for db
                $stmt = $db->prepare($query); //we want to stop crn from having SQL Injection, but keep it in the file
                $stmt->bindParam(':crn', $crn, SQLITE3_INTEGER);
                $stmt->execute(); //populate db from csv using our prepared query
            }

            $db->backup($db, "temp", $GLOBALS['dbPath']);
            fclose($handle);
        }

        header("Location: ../public/dashboard.php");
    }
    else{throw new Exception("entergrades failed");}
}
catch(Exception $e)
{
    //prepare page for content
    echo '<!DOCTYPE html>
            <html lang="en">
            <head>
                <link rel="stylesheet" href="../resources/secure_app.css">
                <link rel="icon" type="image/svg" href="../resources/Header_Lock_Image.svg">
                <script async src="../resources/nav.js"></script>
                <meta charset="utf-8" />
                <title>Secure App - Course Enroll</title>
            </head>';

    //Display error information
    echo 'Caught exception: ',  $e->getMessage(), "<br>";
    var_dump($e->getTraceAsString());
    echo 'in '.'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']."<br>";

    $allVars = get_defined_vars();
    debug_zval_dump($allVars);
}