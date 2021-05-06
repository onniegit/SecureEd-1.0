<?php
try {
    /*Get DB connection*/
    require_once "../src/DBController.php";

    if (isset($_POST['submit'])) { //checks if submit var is set
        $currentDirectory = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..') ;
        $uploadDirectory = "\uploads\\";

        $filename = $_FILES['file']['name'];
        $filesize = $_FILES['file']['size'];
        $filetmp  = $_FILES['file']['tmp_name'];
        $fileType = $_FILES['file']['type'];

        $uploadPath = $currentDirectory . $uploadDirectory . basename($filename);

        copy($filetmp, $uploadPath);

        $handle = fopen(($_FILES['file']['tmp_name']), "r"); //sets a read-only pointer at beginning of file
        $crn = $_POST['crn']; //grabs CRN from form
        $path = pathinfo($_FILES['file']['name']); //path info for file


        if($path['extension'] == 'csv') { //check if file is .csv
            while (($data = fgetcsv($handle, 9001, ",")) !== FALSE) { //iterate through csv
                $crn = $db->escapeString($crn); //sanitize the crn
                $query = "INSERT INTO Grade VALUES ('$crn', '$data[0]', '$data[1]')";//create query for db
                $db->exec($query);
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
    include_once "ErrorHeader.php";

    //Display error information
    echo 'Caught exception: ',  $e->getMessage(), "<br>";
    var_dump($e->getTraceAsString());
    echo 'in '.'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']."<br>";

    $allVars = get_defined_vars();
    debug_zval_dump($allVars);
}