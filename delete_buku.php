<?php
include "koneksi_oracle.php";

$no_buku = "10";

$sql=ociparse($con,"delete buku where nobuku='$no_buku'");
ociexecute($sql);
if (ocirowcount($sql)>0)
	echo "Berhasil Delete Data";
else
	echo "Gagal Delete Data";	

?>