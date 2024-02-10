<?php
function pembagian($a, $b) {
    if ($b == 0) {
        throw new Exception("Pembagian oleh nol tidak diperbolehkan.");
    }

    return $a / $b;
}

try {
    $result = pembagian(10, 0);
} catch (Exception $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
}
?>
