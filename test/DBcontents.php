<?php
$GLOBALS['dbPath'] = '../db/persistentconndb.sqlite';
$db = new SQLite3($GLOBALS['dbPath'],  $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE , $encryptionKey = "");


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
?>