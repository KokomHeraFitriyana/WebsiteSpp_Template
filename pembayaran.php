<?php 
session_start();
include 'koneksi.php';
include 'header.php';
 ?>
<div class="row">
 <div class="col col-md-10 offset-md-2 fixed-top fixed-right">
 <div class="card shadow mb-4 ">
 	<div class="card-body">
 		<form action="" method="get">
 		<table class="table">
 			<tr>
 				<td>NIS</td>
 				<td>:</td>
 				<td><input type="text" name="nis" placeholder="Masukkan NIS" class="form-control"></td>
 				<td><button type="submit" class="btn btn-primary" name="cari">Search</button></td>
 			</tr>	
 		</table>	
 		</form>	
 	</div>	
 </div>
 </div>
</div>
<?php 
if(isset($_GET['nis']) && $_GET['nis'] !=''){
	$nis = $_GET['nis'];
	$query = "SELECT siswa.*,angkatan.*,kelas.* FROM siswa,angkatan,kelas WHERE siswa.id_angkatan = angkatan.id_angkatan AND siswa.id_kelas = kelas.id_kelas AND siswa.nis = '$nis' ";
    $exec = mysqli_query($conn,$query);

    // die();
    if(mysqli_num_rows($exec) !== 0) {
	    $siswa = mysqli_fetch_assoc($exec);
	    $id_siswa = $siswa['id_siswa'];
	    $nis = $siswa['nis'];
 ?>

<div class="card shadow mb-4 mt-5">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Biodata Siswa</h6>	
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<tr>
					<td>Nomor</td>
					<td><?= $siswa['nis'] ?></td>
				</tr>
				<tr>
					<td>Nama Siswa</td>
					<td><?= $siswa['nama'] ?></td>
				</tr>
				<tr>
					<td>Kelas</td>
					<td><?= $siswa['nama_kelas'] ?></td>
				</tr>
				<tr>
					<td>Tahun ajaran</td>
					<td><?= $siswa['nama_angkatan'] ?></td>
				</tr>
			</table>
		</div>
	</div>
</div>

<!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pembayaran</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Bulan</th>
                                            <th>Jatuh Tempo</th>
                                            <th>No Bayar</th>
                                            <th>Tanggal Bayar</th>
                                            <th>Jumlah</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    	<?php
                                    	$no=1;
                                    	$query = "SELECT * from pembayaran WHERE id_siswa = '$id_siswa' order by jatuhtempo ASC ";
                                    	$exec = mysqli_query($conn,$query);
                                    	while($res = mysqli_fetch_assoc($exec)) { ?>
                                    		<tr>
                                    			<td><?= $no++ ?></td>
                                    			<td><?= $res['bulan'] ?></td>
	                                            <td><?= $res['jatuhtempo'] ?></td>
	                                            <td><?= $res['nobayar'] ?></td>
	                                            <td><?= $res['tglbayar'] ?></td>
	                                            <td><?= $res['jumlah'] ?></td>
	                                            <td><?= $res['ket'] ?></td>
	                                            <td>
	                                            	<?php
                                            	if ($res['nobayar'] == ''){
                                            		echo "<a href='proses_transaksi.php?nis=$nis&act=bayar&id=$res[idspp]'></a>";
                                            		echo "<a class='btn btn-primary btn-sm' href='proses_transaksi.php?nis=$nis&act=bayar&id=$res[idspp]'>Bayar</a>";
                                            	} else{
                                            		echo "</a>";
                                            		echo "<a class='btn btn-danger btn-sm mr-2' href='proses_transaksi.php?nis=$nis&act=batal&id=$res[idspp]'>Batal</a>";
                                            		echo "<a class='btn btn-success btn-sm' href='cetak_slip_pembayaran.php?nis=$nis&act=cetak&id=$res[idspp]' target='_blank'>Cetak</a>";
                                            	}

	                                            	 ?>
	                                            </td>
                                    		</tr>
                                    		<?php } ?>
           
                                    </tbody>
                                </table>
                               </div>
                           </div>
                        <?php 
                    }else { 
                        ?>
                        <div class="card shadow mb-4">
                        	<div class="card-body">
                        		<h5>Data Tidak Tersedia</h5>
                        		
                        	</div>
                        	
                        </div>
                    <?php } ?>

                <?php } ?>
                       </div>

  <?php include 'footer.php'; ?>
