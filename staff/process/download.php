<?php

// Download files process

if (!empty($_GET['file'])) {
    $filename = basename($_GET['file']);
    $filepath = "../".$_GET['file'];
    if (!empty($filename) && file_exists($filepath)) {
        // Define Headers
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/zip");
        header("Content-Transfer-Emcoding: binary");

        readfile($filepath);
        exit;
    } else {
        echo "This File Does not exist.";
    }
}
