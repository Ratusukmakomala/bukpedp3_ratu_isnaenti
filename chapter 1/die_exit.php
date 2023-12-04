Ketika suatu kesalahan terjadi dan Anda ingin menghentikan eksekusi skrip, Anda dapat menggunakan die() atau exit().

  <?php
$file = fopen("file.txt", "r");

if (!$file) {
    die("Gagal membuka file!");
}

// Kode lainnya...
?>
