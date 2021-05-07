<?php

$GLOBALS['dbPath'] = 'db/persistentconndb.sqlite';

if(file_exists($GLOBALS['dbPath'])) {
    unlink($GLOBALS['dbPath']);
}

array_map('unlink', glob("uploads/*"));

shell_exec('php config/Config.php');