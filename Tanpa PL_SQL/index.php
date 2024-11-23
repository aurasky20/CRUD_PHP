<?php
// Menyertakan koneksi dari connection.php
include "controllers/connection.php";
include "template/header.php";
include "controllers/controller.php";

// Query untuk mengambil data dari tabel PEGAWAI
$query = "SELECT * FROM PEGAWAI";
$stid = oci_parse($conn, $query);

// Eksekusi query
if (!oci_execute($stid)) {
    $error = oci_error($stid);
    echo "Gagal menjalankan query: " . $error['message'];
    exit;
}

// Menampilkan data dalam bentuk tabel HTML
echo "<main class='col-md-9 ms-sm-auto col-lg-10 px-md-4'>"; 
echo "<div class='container mt-5'>"; 

// Judul tabel
echo "<h2 class='text-center mb-5'>Data Pegawai</h2>"; 

//Tambah Pegawai Button
echo "  <div class='btn-tambah-pegawai mb-2'>
            <button type='button' class='btn btn-warning mb-3 px-3 shadow-sm' data-bs-toggle='modal' data-bs-target='#formModal'>
                Tambah Pegawai
            </button>
        </div>"; 
echo "<table class='table table-striped table-bordered mb-5'> 
        <thead class='table-dark'>
            <tr>
                <th class='text-center'>NIP</th>
                <th class='text-center'>Nama Pegawai</th>
                <th class='text-center'>Email</th>
                <th class='text-center'>No. Telepon</th>
                <th class='text-center'>Tanggal Diterima</th>
                <th class='text-center'>Gaji</th>
                <th class='text-center'>ID Department</th>
                <th class='text-center'>Tindakan</th>
            </tr>
        </thead>
        <tbody>";

// Iterasi hasil query
while ($row = oci_fetch_assoc($stid)) {
    echo "<tr>
        <td class='text-center'>" . htmlspecialchars($row['EMPLOYEE_ID'] ?? '', ENT_QUOTES) . "</td>
        <td>" . htmlspecialchars($row['FIRST_NAME'] ?? '', ENT_QUOTES) . "</td>
        <td>" . htmlspecialchars($row['EMAIL'] ?? '', ENT_QUOTES) . "</td>
        <td class='text-center'>" . htmlspecialchars($row['PHONE_NUMBER'] ?? '', ENT_QUOTES) . "</td>
        <td class='text-center'>" . htmlspecialchars($row['HIRE_DATE'] ?? '', ENT_QUOTES) . "</td>
        <td class='text-center'>" . htmlspecialchars($row['SALARY'] ?? '', ENT_QUOTES) . "</td>
        <td class='text-center'>" . htmlspecialchars($row['DEPARTMENT_ID'] ?? '', ENT_QUOTES) . "</td>
        <td class='d-flex justify-content-evenly'> 
                    <button 
                        class='btn btn-warning btn-sm edit-btn' 
                        data-id='" . htmlspecialchars($row['EMPLOYEE_ID'] ?? '') . "'
                        data-nama='" . htmlspecialchars($row['FIRST_NAME'] ?? '') . "'
                        data-email='" . htmlspecialchars($row['EMAIL'] ?? '') . "'
                        data-telepon='" . htmlspecialchars($row['PHONE_NUMBER'] ?? '') . "' 
                        data-tgl_diterima='" . (isset($row['HIRE_DATE']) ? date('Y-m-d', strtotime($row['HIRE_DATE'])) : '') . "' 
                        data-gaji='" . htmlspecialchars($row['SALARY'] ?? '') . "' 
                        data-department='" . htmlspecialchars($row['DEPARTMENT_ID'] ?? '') . "' 
                        data-bs-toggle='modal' data-bs-target='#editModal'>
                        Edit
                    </button>
            <a href='controllers/hapus.php?id=" . htmlspecialchars($row['EMPLOYEE_ID'] ?? '', ENT_QUOTES) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
        </td>
    </tr>";

}

echo "</tbody></table>";
echo "</div></main></div></div>
"; // Penutup container

// Menutup koneksi
oci_free_statement($stid);
oci_close($conn);

// Modal TAMBAH DATA PEGAWAI
echo '
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="formModalLabel">Tambah Pegawai</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Pegawai</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">No. Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" required>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_diterima" class="form-label">Tanggal Diterima</label>
                        <input type="date" class="form-control" id="tgl_diterima" name="tgl_diterima" required>
                    </div>
                    <div class="mb-3">
                        <label for="gaji" class="form-label">Gaji</label>
                        <input type="number" class="form-control" id="gaji" name="gaji" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_department" class="form-label">ID Department</label>
                        <input type="number" class="form-control" id="id_department" name="id_department" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" name="insert" class="btn btn-warning">Tambah Data</button>
                </div>
            </form>
        </div>
    </div>
</div>';

// EDIT DATA PPEGAWAI
echo '
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" action="controllers/edit.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="edit-id" name="employee_id">
                    <div class="mb-3">
                        <label for="edit-nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="edit-nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit-email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-telepon" class="form-label">No. Telepon</label>
                        <input type="text" class="form-control" id="edit-telepon" name="telepon" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-tgl_diterima" class="form-label">Tanggal Diterima</label>
                        <input type="date" class="form-control" id="edit-tgl_diterima" name="tgl_diterima" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-gaji" class="form-label">Gaji</label>
                        <input type="number" class="form-control" id="edit-gaji" name="gaji" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-department" class="form-label">Departemen</label>
                        <input type="number" class="form-control" id="edit-department" name="department_id" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
';


include "template/footer.php";
?>
