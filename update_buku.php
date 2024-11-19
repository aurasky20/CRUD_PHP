<?php
include "koneksi_oracle.php";

$no_buku = "10";
$nama_buku = "Novel Action";
$kode_jenis_buku = "2";
$nib = "4321";
$pengarang = "Andi Noya";

$sql=ociparse($con,"update buku set nama_buku='$nama_buku',kode_jenis_buku='$kode_jenis_buku',nib='$nib',pengarang='$pengarang' where nobuku='$no_buku'");
ociexecute($sql);
if (ocirowcount($sql)>0)
	echo "Berhasil Update Data";
else
	echo "Gagal Update Data";	

?>