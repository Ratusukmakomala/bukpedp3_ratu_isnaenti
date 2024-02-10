<?php
$file = "error.log";
$message = "Terjadi kesalahan pada " . date("Y-m-d H:i:s") . "\n";
error_log($message, 3, $file);
?>
