<?php
function handleErrors($errno, $errstr, $errfile, $errline) {
    echo "Kesalahan: $errstr di $errfile pada baris $errline";
}

set_error_handler("handleErrors");
?>
