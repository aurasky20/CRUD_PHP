<?php
// Konfigurasi koneksi
$dsn = '//localhost:1522/orcl';
$username = 'hr';      
$password = 'hr';       

// Membuat koneksi
$conn = oci_connect($username, $password, $dsn);

if (!$conn) {
    $error = oci_error();
    echo "Koneksi ke Oracle gagal: " . $error['message'];
    exit;
}
?>
