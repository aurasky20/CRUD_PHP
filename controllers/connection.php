

<?php
// Konfigurasi koneksi
$dsn = '//localhost:1522/orcl'; // Sesuaikan dengan host, port, dan SID Anda
$username = 'hr';        // Sesuaikan username Oracle
$password = 'hr';        // Sesuaikan password Oracle

// Membuat koneksi
$conn = oci_connect($username, $password, $dsn);

if (!$conn) {
    $error = oci_error();
    echo "Koneksi ke Oracle gagal: " . $error['message'];
    exit;
}
?>

