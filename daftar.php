<?php
include_once("config.php");

if(isset($_POST['Submit'])) 
{	
	$nama = $_POST['nama'];
	$nim = $_POST['nim'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$alamat = $_POST['alamat'];
	$email = $_POST['email'];
	$no_telp = $_POST['no_telp'];
	$kerja = $_POST['kerja'];
	if($kerja == 'Iya')
	{
		$nama_perusahaan = $_POST['nama_perusahaan'];
		$shift = $_POST['shift'];
	}
	else
	{
		$nama_perusahaan = '-';
		$shift = '-';
	}
		
	$sql_insert = "INSERT INTO daftar(nim,nama,jenis_kelamin,alamat,email,no_telp,kerja,nama_perusahaan,shift) VALUES('$nim','$nama','$jenis_kelamin','$alamat','$email','$no_telp','$kerja','$nama_perusahaan','$shift')";

	$stmt = $conn->prepare($sql_insert);
    $stmt->bindValue(1, $nim);
    $stmt->bindValue(2, $nama);
    $stmt->bindValue(3, $jenis_kelamin);
    $stmt->bindValue(4, $alamat);
	$stmt->bindValue(5, $email);
	$stmt->bindValue(6, $no_telp);
	$stmt->bindValue(7, $kerja);
	$stmt->bindValue(8, $nama_perusahaan);
	$stmt->bindValue(9, $shift);
    $stmt->execute();
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>