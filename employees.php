<?php
// Menyertakan koneksi dari connection.php
include "connection.php";
include "template/header.php";

// Query untuk mengambil data dari tabel EMPLOYEES
$query = "SELECT EMPLOYEE_ID, JOB_ID, FIRST_NAME, LAST_NAME, EMAIL, PHONE_NUMBER, SALARY, HIRE_DATE FROM EMPLOYEES";
$stid = oci_parse($conn, $query);

// Eksekusi query
if (!oci_execute($stid)) {
    $error = oci_error($stid);
    echo "Gagal menjalankan query: " . $error['message'];
    exit;
}

// Menampilkan data dalam bentuk tabel HTML
echo "<div class='container mt-5'>"; // Bootstrap container
echo "<h2 class='text-center mb-5'>Data Pegawai</h2>"; // Judul tabel
echo "<table class='table table-striped table-bordered mb-5'> 
        <thead class='table-dark'>
            <tr>
                <th class='text-center'>NIP</th>
                <th class='text-center'>Pekerjaan</th>
                <th class='text-center'>Nama Pegawai</th>
                <th class='text-center'>Email</th>
                <th class='text-center'>No. Telepon</th>
                <th class='text-center'>Gaji</th>
                <th class='text-center'>Tanggal Diterima</th>
                <th class='text-center'>Tindakan</th>
            </tr>
        </thead>
        <tbody>";
        

// Iterasi hasil query
while ($row = oci_fetch_assoc($stid)) {
    echo "<tr>
            <td>" . htmlspecialchars($row['EMPLOYEE_ID']) . "</td>
            <td>" . htmlspecialchars($row['JOB_ID']) . "</td>
            <td>" . htmlspecialchars($row['FIRST_NAME']) . " " .  htmlspecialchars($row['LAST_NAME'])  ."</td>
            <td>" . htmlspecialchars($row['EMAIL']) . "</td>
            <td>" . htmlspecialchars($row['PHONE_NUMBER']) . "</td>
            <td>" . htmlspecialchars($row['SALARY']) . "</td>
            <td>" . htmlspecialchars($row['HIRE_DATE']) . "</td>
            <td class='d-flex justify-content-evenly'> 
                <a href='edit.php?id=" . htmlspecialchars($row['EMPLOYEE_ID']) . "' class='btn btn-warning btn-sm'>Edit</a>
                <a href='delete.php?id=" . htmlspecialchars($row['EMPLOYEE_ID']) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
            </td>
          </tr>";
}

echo "</tbody></table>";
echo "</div>"; // Penutup container

// Menutup koneksi
oci_free_statement($stid);
oci_close($conn);

include "template/footer.php";
?>
