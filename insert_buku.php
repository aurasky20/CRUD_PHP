<?php
include "koneksi_oracle.php";

$no_buku = "10";
$nama_buku = "Novel Terlaris";
$kode_jenis_buku = "1";
$nib = "1234";
$pengarang = "Andi Yusuf";
//echo "insert into buku (no_buku,nama_buku,kode_jenis_buku,nib,pengarang) values ('$no_buku','$nama_buku','$kode_jenis_buku','$nib','$pengarang')";
$sql=ociparse($con,"insert into buku (nobuku,nama_buku,kode_jenis_buku,nib,pengarang) values ('$no_buku','$nama_buku','$kode_jenis_buku','$nib','$pengarang')");
ociexecute($sql);
if (ocirowcount($sql)>0)
	echo "Berhasil Entri Data";
else
	echo "Gagal Entri Data";	

?>