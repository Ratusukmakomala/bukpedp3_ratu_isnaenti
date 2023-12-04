<?php
$koneksi = mysqli_connect("localhost", "username", "password", "database");
$result = mysqli_query($koneksi, "SELECT * FROM tabel");
while ($row = mysqli_fetch_assoc($result)) {
    echo $row['kolom_nama'];
}
mysqli_close($koneksi);
?>
