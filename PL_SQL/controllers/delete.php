<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $employee_id = $_GET['id'];

    $stid = oci_parse($conn, "BEGIN PROC_DELETE_EMP(:employee_id); END;");
    oci_bind_by_name($stid, ":employee_id", $employee_id);

    if (oci_execute($stid)) {
        echo "<script>alert('Data berhasil dihapus!'); window.location.href='../index.php';</script>";
    } else {
        $error = oci_error($stid);
        echo "<script>alert('Gagal menghapus data: " . htmlspecialchars($error['message']) . "');</script>";
    }

    oci_free_statement($stid);
    oci_close($conn);
}
?>
