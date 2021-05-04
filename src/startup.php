<?php

$GLOBALS['dbPath'] = 'db/persistentconndb.sqlite';

if(file_exists($GLOBALS['dbPath'])) {
    unlink($GLOBALS['dbPath']);
}

shell_exec('php config/Config.php');