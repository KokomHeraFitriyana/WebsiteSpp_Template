<?php 
session_start();
include 'function/function_rupiah.php';
if(isset($_SESSION['admin']) ) {
	include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Slip Pembayaran SPP</title>
	
	<style >
		body{
			font-family: arial;
		}
		
		table{
			border-collapse: collapse;
		}
	</style>
</head>
<body onload="window.print();">
	<h3>SMP Muhammadiyah 01 Paguyangan<b><br/>LAPORAN PEMBAYARAN SPP</b></h3>
	<br/>
	<hr/>
	<?php
	$nis = $_GET['nis'];
	$siswa = mysqli_query($conn,"SELECT siswa.*,angkatan.*,kelas.* FROM siswa,angkatan,kelas WHERE siswa.id_angkatan = angkatan.id_angkatan AND siswa.id_kelas = kelas.id_kelas AND siswa.nis = '$nis'");
	$sw = mysqli_fetch_assoc($siswa);
	$idspp = $_GET['id'];

	 ?>
	<table>
		<tr>
			<td>Nama Siswa </td>
			<td>:</td>
			<td> <?= $sw['nama'] ?></td>
		</tr>
		<tr>
			<td>Nis </td>
			<td>:</td>
			<td> <?= $sw['nis'] ?></td>
		</tr>
		<tr>
			<td>Kelas </td>
			<td>:</td>
			<td> <?= $sw['nama_kelas'] ?></td>
		</tr>
		<tr>
			<td>Angkatan </td>
			<td>:</td>
			<td> <?= $sw['nama_angkatan'] ?></td>
		</tr>
	</table>
	<hr>
	<table border="1" cellspacing="" cellpadding="4" width="100%">
	<tr>
		<th>NO</th>
		<th>NO. BAYAR</th>
		<th>PEMBAYARAN BULAN</th>
		<th>JUMLAH</th>
		<th>KETERANGAN</th>
	</tr>
	<?php 
	$spp = mysqli_query($conn,"SELECT siswa.*,pembayaran.* FROM siswa,pembayaran WHERE pembayaran.id_siswa = siswa.id_siswa AND pembayaran.idspp = '$idspp' ORDER BY nobayar ASC");
	$i=1;
	$total=0;
	while($dta=mysqli_fetch_assoc($spp)) :
	 ?>
	<tr>
		<td align="center"><?= $i ?></td>
		<td align="center"><?= $dta['nobayar'] ?></td>
		<td align="center"><?= $dta['bulan'] ?></td>
		<td align="right"><?= format_rupiah($dta['jumlah']) ?></td>
		<td align="center"><?= $dta['ket'] ?></td>
	</tr>
	<?php $i++; ?>
	<?php $total += $dta['jumlah'] ?>


<?php endwhile; ?>
<tr>
	<td colspan="4" align="right">TOTAL</td>
	<td align="right"><b><?= format_rupiah($total) ?></b></td>
</tr>


	</table>
<table width="100%">
	<tr>
		<td></td>
		<td width="200px">
			<BR/>
			<p>Paguyangan , <?= date('d/m/Y') ?> <br/>
				KHAERIYAH,
			<br/>
			<br/>
			<br/>
		<p>__________________________</p>
		</td>
	</tr>
</table>


	
</body>
</html>


<?php 
} else {
	header("location : loginauth.php");
}
?>