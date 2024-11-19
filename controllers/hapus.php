<?php
include "connection.php";

// Fungsi untuk Delete Data

if (isset($_GET['id'])) {
    $employee_id = $_GET['id'];

    // Query untuk delete data
    $query = "DELETE FROM PEGAWAI WHERE EMPLOYEE_ID = :employee_id";
    $stid = oci_parse($conn, $query);

    oci_bind_by_name($stid, ":employee_id", $employee_id);

    if (oci_execute($stid)) {
        echo "<script>alert('Data berhasil dihapus!'); window.location.href='../index.php';</script>";
    } else {
        $error = oci_error($stid);
        echo "<script>alert('Gagal menghapus data: " . htmlspecialchars($error['message']) . "');</script>";
    }

    oci_free_statement($stid);
} else {
    echo "<script>alert('Data tidak ditemukan!'); window.location.href='../index.php';</script>";
}

?>