<?php
include 'controllers/connection.php';

// Query data
$stid = oci_parse($conn, "SELECT * FROM PEGAWAI");
oci_execute($stid);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>CRUD PHP Oracle</title>
</head>
<body>
    <h2>Data Pegawai</h2>
    <table border="1">
        <tr>
            <th>NIP</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Tanggal Diterima</th>
            <th>Gaji</th>
            <th>Department</th>
            <th>Tindakan</th>
        </tr>
        <?php while ($row = oci_fetch_assoc($stid)): ?>
            <tr>
                <td><?= htmlspecialchars($row['EMPLOYEE_ID']); ?></td>
                <td><?= htmlspecialchars($row['FIRST_NAME']); ?></td>
                <td><?= htmlspecialchars($row['EMAIL']); ?></td>
                <td><?= htmlspecialchars($row['PHONE_NUMBER']); ?></td>
                <td><?= htmlspecialchars($row['HIRE_DATE']); ?></td>
                <td><?= htmlspecialchars($row['SALARY']); ?></td>
                <td><?= htmlspecialchars($row['DEPARTMENT_ID'] ?? '-'); ?></td>
                <td>
                    <a href="controllers/edit.php?id=<?= $row['EMPLOYEE_ID']; ?>">Edit</a>
                    <a href="controllers/delete.php?id=<?= $row['EMPLOYEE_ID']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <h2>Tambah Data</h2>
    <form action="controllers/insert.php" method="POST">
        <input type="text" name="nip" placeholder="NIP" required><br>
        <input type="text" name="nama" placeholder="Nama" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="text" name="telepon" placeholder="Telepon" required><br>
        <input type="date" name="tgl_diterima" required><br>
        <input type="number" name="gaji" placeholder="Gaji" required><br>
        <input type="number" name="id_department" placeholder="Department ID" required><br>
        <button type="submit">Tambah</button>
    </form>
</body>
</html>

<?php
oci_free_statement($stid);
oci_close($conn);
?>
