<?php
    /*Ensures the database was initialized and obtain db link*/
    $GLOBALS['dbPath'] = '../db/persistentconndb.sqlite';
    global $db;
    $db = new SQLite3($GLOBALS['dbPath'], $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE, $encryptionKey = "");

?>