<?php
include('../config/ConfigV2.php');

$sql =<<<EOF
Select * From User;
EOF;
Global $db;
$ret = $db->query($sql);
while($row = $ret->fetchArray(SQLITE3_ASSOC) )
{
    echo "Email = " . $row['Email'] . "\n";
    echo "AccountType = " . $row['AccountType'] . "\n";
    echo "Password = " . $row['Password'] . "\n";
    echo "Name = " . $row['Name'] . "\n";
    echo "DOB = " . $row['DOB'] . "\n";
    echo "Year = " . $row['Year'] . "\n";
    echo "Rank = " . $row['Rank'] . "\n";
    echo "Security Question = " . $row['SQuestion'] . "\n";
    echo "Security Answer = " . $row['SAnswer'] . "\n";
}

?>