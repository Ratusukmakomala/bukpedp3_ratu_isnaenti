<?php
$data = file_get_contents("https://api.example.com/data");
$decoded_data = json_decode($data, true);
