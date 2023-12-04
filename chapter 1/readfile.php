<?php
$file = fopen("file.txt", "r");
echo fread($file, filesize("file.txt"));
fclose($file);
?>
