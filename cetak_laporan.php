<?php 
session_start();
include 'function/function_rupiah.php';
if (isset($_SESSION['admin'])) {
	include 'koneksi.php';
	$awal = $_GET['awal'];
	$akhir = $_GET['akhir'];

 ?>
 <!DOCTYPE html>
 <html>
 <head>

 	<title>Laporan Pembayaran</title>

 	<style >
		body{
			font-family: arial;
		}
		
		table{
			border-collapse: collapse;
		}
	</style>

 </head>
 <body onload="window.print()">
 	<h3>SMP Muhammadiyah 01 Paguyangan<b><br/>LAPORAN PEMBAYARAN SPP</b></h3>
	<br/>
	<hr/>
	Tanggal <?= $awal." Sampai ".$akhir; ?>
	<br/>
	<br>
	<table border="1" cellspacing="" cellpadding="4" width="100%">
	<tr>
		<th>NO</th>
		<th>NIS</th>
		<th>NAMA SISWA</th>
		<th>KELAS</th>
		<th>NO. BAYAR</th>
		<th>PEMBAYARAN BULAN</th>
		<th>JUMLAH</th>
		<th>KETERANGAN</th>
	</tr> 
	<?php 
	$spp = mysqli_query($conn, "SELECT siswa.*, pembayaran.*, kelas.nama_kelas 
                            FROM siswa
                            INNER JOIN pembayaran ON pembayaran.id_siswa = siswa.id_siswa
                            INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas
                            WHERE tglbayar BETWEEN '$awal' AND '$akhir' ORDER BY nobayar");


	$i=1;
	$total = 0;
	while($dta=mysqli_fetch_assoc($spp)) :
	 ?>
	<tr>
		<td align="center"><?= $i ?></td>
		<td align="center"><?= $dta['nis'] ?></td>
		<td align="left"><?= $dta['nama'] ?></td>
		<td align="center"><?= $dta['nama_kelas'] ?></td>
		<td align="center"><?= $dta['nobayar'] ?></td>
		<td align="center"><?= $dta['bulan'] ?></td>
		<td align="right"><?= format_rupiah($dta['jumlah']) ?></td>
		<td align="center"><?= $dta['ket'] ?></td>
	</tr>
	<?php $i++; ?>
	<?php $total += $dta['jumlah']; ?>

<?php endwhile; ?>

<tr>
	<td colspan="7" align="right">TOTAL</td>
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
}else { 
	header("location : loginauth.php");
} 
?>