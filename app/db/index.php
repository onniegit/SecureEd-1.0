<!-- NOTICE -->

<!-- The following code is a workaround of the PHP built-in webserver, as it is not meant to show the directory
 structure of the project if you browse around. This code was provided by user @Syco for use by the public, and the
 credit is all his. No changes have been made.

 The original solution can be found at: https://stackoverflow.com/a/47310392 -->

<style>
    a {
        color: black;
        width: 100%;
        display: flex;
        flex-direction: row;
    }

    a:hover {
        background-color: #77AAFF;
        color: black;
    }

    .linkLeft {
        flex-grow: 0;
    }

    .linkCenter {
        flex-grow: 1;
        margin: -3px 10px 3px;
        border-bottom: 1px dotted black;
    }

    .linkRight {
        flex-grow: 0;
    }
</style>

<?php
$dir = realpath(isset($_GET['dir']) ? $_GET['dir'] : ".");
if (is_dir($dir)) {
    echo "<h2>Index of $dir:</h2>\n";
    $files = array_diff(scandir($dir), array('..', '.'));
    usort($files, function($a, $b) use ($dir) {
        if (is_dir("{$dir}/{$a}") == is_dir("{$dir}/{$b}")) {
            return strnatcasecmp($a, $b);
        } else {
            return is_dir("{$dir}/{$a}") ? -1 : 1;
        }
    });
    echo "<a href='?dir=" . urlencode(realpath("{$dir}/..")) . "'>⏎</a>\n";
    foreach ($files as $file) {
        if (is_dir("{$dir}/{$file}")) {
            $typef = "[directory]";
        } else {
            $typef = "[" . pathinfo($file, PATHINFO_EXTENSION) . " file]";
        }
        ?>
        <a href='?dir=<?= urlencode("{$dir}/{$file}"); ?>'>
            <div class='linkLeft'><?= $file; ?></div>
            <div class='linkCenter'></div>
            <div class='linkRight'><?= $typef; ?></div>
        </a>
        <?php
    }
} else if (is_file($dir)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($dir) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($dir));
    readfile($dir);
}