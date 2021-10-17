<?php
//Access Control
//echo "Before session started <br>";
session_start(); //required to bring session variables into context
//echo "Session started <br>";

//echo "Before if 1 <br>";

//echo $_SESSION['email'];
//echo "<br>";

if (isset($_SESSION['email']))
{
    //echo "Session is set <br>";
    if (!empty($_SESSION['email']))
    {
        //echo "Email is non-empty <br>";
        if (!($_SESSION['acctype'] == 1)) //check if user is not admin
        {
            //echo "User is not admin <br>";
            http_response_code(403);
            die('Forbidden');
        }
        else
        {
            //echo "User is admin <br>";
        }
    }
    else
    {
        //echo "Email is empty <br>";
    }
}

//check that session exists and is nonempty

else
{
    //echo "Session is not set. <br>";
    http_response_code(403);
    die('Forbidden');
}

?>

<?php
try {
    /*Get DB connection*/
    require_once "../src/DBController.php";

    /*Get information from the search (post) request*/
    $acctype = $_POST['acctype'];
    $password = hash('ripemd256', $_POST['password']); //convert password to 80 byte hash using ripemd256 before saving
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob']; //is already UTC
    $email = strtolower($_POST['email']); //is converted to lower
    $studentyear = $_POST['studentyear']; //only if student, ensure null otherwise (must be a number)
    $facultyrank = $_POST['facultyrank']; //only if faculty, ensure null otherwise
    $squestion = $_POST['squestion'];
    $sanswer = $_POST['sanswer'];

    if($acctype==null)
    {throw new Exception("input did not exist");}

    /*Checking studentyear and facultyrank*/
    if ($acctype === "3") {
        $facultyrank = null;
    } else if ($acctype === "2") {
        $studentyear = null;
    }

    /*Check for a valid UserID to use. Assumes Users count in order*/
    $rows = $db->query("SELECT COUNT(*) as count FROM User");
    $row = $rows->fetchArray();
    $newUserID = $row['count'] + 927000000; //must always be 1 higher than previous


    /*Check if user already exists*/
    $query = "SELECT Email FROM User WHERE Email = :email";
    $stmt = $db->prepare($query); //prevents SQL injection by escaping SQLite characters
    $stmt->bindValue(':email', $email);
    $results = $stmt->execute();

    if ($results) //user doesn't already exist
    {
        /*Update the database with the new info*/
        $query = "INSERT INTO User VALUES (:newUserID, :email, :acctype, :password, :fname, :lname, :dob, :studentyear, :facultyrank, :squestion, :sanswer)";
        $stmt = $db->prepare($query); //prevents SQL injection by escaping SQLite characters
        $stmt->bindParam(':newUserID', $newUserID, SQLITE3_INTEGER);
        $stmt->bindParam(':email', $email, SQLITE3_TEXT);
        $stmt->bindParam(':acctype', $acctype, SQLITE3_INTEGER);
        $stmt->bindParam(':password', $password, SQLITE3_TEXT);
        $stmt->bindParam(':fname', $fname, SQLITE3_TEXT);
        $stmt->bindParam(':lname', $lname, SQLITE3_TEXT);
        $stmt->bindParam(':dob', $dob, SQLITE3_TEXT);
        $stmt->bindParam(':studentyear', $studentyear, SQLITE3_INTEGER);
        $stmt->bindParam(':facultyrank', $facultyrank, SQLITE3_TEXT);
        $stmt->bindParam(':squestion', $squestion, SQLITE3_TEXT);
        $stmt->bindParam(':sanswer', $sanswer, SQLITE3_TEXT);
        global $results;
        $results = $stmt->execute();
    }

//is true on success and false on failure (can fail in either query)
    if (!$results) {
        throw new Exception("Create account failed");
    } else {
        //backup database
        $db->backup($db, "temp", $GLOBALS['dbPath']);
        //redirect
        header("Location: ../public/dashboard.php");
    }
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