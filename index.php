<?php
	include_once("config.php");

	$load_data = "SELECT * FROM daftar ORDER BY nama ASC";
	$stmt = $conn->query($load_data);
    $data = $stmt->fetchAll();
?>

<html>
<head>	
	<title>Pendaftaran KKN</title>
</head>

<body>
	<h1>PENDAFTARAN KKN</h1>
	<h2>Form Pendaftaran</h2>
	<form action="daftar.php" method="post" name="form1">
		<table width="25%" border="0">
			<tr> 
				<td>NIM*</td>
				<td><input type="text" name="nim" required="required"></td>
			</tr>
			<tr> 
				<td>Nama*</td>
				<td><input type="text" name="nama" required="required"></td>
			</tr>
			<tr> 
				<td>Jenis Kelamin*</td>
				<td>
					<input type="radio" name="jenis_kelamin" value="Laki - laki" checked="checked"> Laki - laki <br>
					<input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan
				</td>
			</tr>
			<tr> 
				<td>Alamat*</td>
				<td><input type="text" name="alamat" required="required"></td>
			</tr>
			<tr> 
				<td>Email*</td>
				<td><input type="email" name="email" required="required"></td>
			</tr>
			<tr> 
				<td>No. Telp*</td>
				<td><input type="text" name="no_telp" required="required"></td>
			</tr>
			<tr> 
				<td>Status Kerja*</td>
				<td>
					<input type="radio" name="kerja" value="Iya" checked="checked"> Iya <br>
					<input type="radio" name="kerja" value="Tidak"> Tidak
				</td>
			</tr>
			<tr> 
				<td>Nama Perusahaan</td>
				<td><input type="text" name="nama_perusahaan"></td>
			</tr>
			<tr> 
				<td>Shift</td>
				<td><input type="text" name="shift"></td>
			</tr>
			<tr> 
				<td></td>
				<td><input type="submit" name="Submit" value="Daftar"></td>                
			</tr>
		</table>
	</form>
	
	<h2>Data Mahasiswa yang terdaftar</h2>
	<table width='80%' border=0>
		<tr bgcolor='#CCCCCC'>
			<td>#</td>
			<td>NIM</td>
			<td>Nama</td>
			<td>Jenis Kelamin</td>
			<td>Alamat</td>
			<td>Email</td>
			<td>No. Telp</td>
			<td>Status Kerja</td>
			<td>Nama Perusahaan</td>
			<td>Shift</td>
		</tr>
		<?php 
			$no = 1;
			foreach($data as $mhs) 
			{ 		
				echo "<tr>";
					echo "<td>".$no++."</td>";
					echo "<td>".$mhs['nim']."</td>";
					echo "<td>".$mhs['nama']."</td>";
					echo "<td>".$mhs['jenis_kelamin']."</td>";	
					echo "<td>".$mhs['alamat']."</td>";	
					echo "<td>".$mhs['email']."</td>";	
					echo "<td>".$mhs['no_telp']."</td>";	
					echo "<td>".$mhs['kerja']."</td>";	
					echo "<td>".$mhs['nama_perusahaan']."</td>";	
					echo "<td>".$mhs['shift']."</td>";	
				echo "</tr>";
			}
		?>
	</table>
</body>
</html>
