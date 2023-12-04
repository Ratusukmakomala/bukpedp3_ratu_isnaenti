<?php
$image = imagecreatefromjpeg("gambar.jpg");
$scaled_image = imagescale($image, 200, 150);
imagejpeg($scaled_image, "gambar_kecil.jpg");
