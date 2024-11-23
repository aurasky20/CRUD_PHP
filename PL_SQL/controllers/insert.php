<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $tgl_diterima = $_POST['tgl_diterima'];
    $gaji = $_POST['gaji'];
    $id_department = $_POST['id_department'];

    $stid = oci_parse($conn, "BEGIN PROC_INSERT_EMP(:nip, :nama, :email, :telepon, TO_DATE(:tgl_diterima, 'YYYY-MM-DD'), :gaji, :id_department); END;");

    oci_bind_by_name($stid, ":nip", $nip);
    oci_bind_by_name($stid, ":nama", $nama);
    oci_bind_by_name($stid, ":email", $email);
    oci_bind_by_name($stid, ":telepon", $telepon);
    oci_bind_by_name($stid, ":tgl_diterima", $tgl_diterima);
    oci_bind_by_name($stid, ":gaji", $gaji);
    oci_bind_by_name($stid, ":id_department", $id_department);

    if (oci_execute($stid)) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='../index.php';</script>";
    } else {
        $error = oci_error($stid);
        echo "<script>alert('Gagal menambahkan data: " . htmlspecialchars($error['message']) . "');</script>";
    }

    oci_free_statement($stid);
    oci_close($conn);
}
?>
