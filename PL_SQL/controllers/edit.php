<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = $_POST['employee_id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $tgl_diterima = $_POST['tgl_diterima'];
    $gaji = $_POST['gaji'];
    $department_id = $_POST['department_id'];

    // Query untuk memanggil procedure
    $stid = oci_parse($conn, "
        BEGIN 
            PROC_UPDATE_EMP(
                :employee_id, 
                :nama, 
                :email, 
                :telepon, 
                TO_DATE(:tgl_diterima, 'YYYY-MM-DD'), 
                :gaji, 
                :department_id
            ); 
        END;
    ");

    // Bind parameter
    oci_bind_by_name($stid, ":employee_id", $employee_id);
    oci_bind_by_name($stid, ":nama", $nama);
    oci_bind_by_name($stid, ":email", $email);
    oci_bind_by_name($stid, ":telepon", $telepon);
    oci_bind_by_name($stid, ":tgl_diterima", $tgl_diterima);
    oci_bind_by_name($stid, ":gaji", $gaji);
    oci_bind_by_name($stid, ":department_id", $department_id);

    // Eksekusi query
    if (oci_execute($stid)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='../index.php';</script>";
    } else {
        $error = oci_error($stid);
        echo "<script>alert('Gagal memperbarui data: " . htmlspecialchars($error['message']) . "');</script>";
    }

    oci_free_statement($stid);
    oci_close($conn);
}
?>
