<?php include 'koneksi.php';

if(isset($_POST['id_siswa'])){
	$id_siswa = $_POST['id_siswa'];
	$query = "SELECT siswa.*,angkatan.*,kelas.* FROM siswa,angkatan,kelas WHERE siswa.id_angkatan = angkatan.id_angkatan AND siswa.id_kelas = kelas.id_kelas AND siswa.id_siswa = $id_siswa";
        $exec = mysqli_query($conn,$query);
        $res = mysqli_fetch_assoc($exec);
        ?>

        <form action="editdatasiswa.php" method="POST">
        	<input type="hidden" name="id_siswa" value="<?= $res['id_siswa'] ?>">
        	<input type="hidden" name="nis" value="<?= $res['nis'] ?>">
        	<input type="text" class="form-control mb-2" name="" disabled="" value="<?= $res['nis'] ?>">
        	<input type="text" class="form-control mb-2" name="nama" value="<?= $res['nama'] ?>">
        	<select class="form-control mb-2" name="id_angkatan">
        		<option selected="">-Pilih Angkatan-</option>
        		<?php
        			$selected="";
        		 	$exec = mysqli_query($conn,"SELECT * FROM angkatan order by id_angkatan");
        		 	while ($angkatan = mysqli_fetch_assoc($exec)):
        		 		if($res['id_angkatan'] == $angkatan['id_angkatan']){
        		 			$selected = 'selected';
        		 		}else {
        		 			$selected="";
        		 		}
        		 		echo "<option $selected value=".$angkatan['id_angkatan'].">".$angkatan['nama_angkatan']."</option>";
        		 	endwhile;
        		 ?>	
        	</select>
        	<select class="form-control mb-2" name="id_kelas">
                <option selected="">-Pilih Kelas-</option>
                <?php 
                    $exec = mysqli_query($conn,"SELECT * FROM kelas order by id_kelas");
                    while ($angkatan = mysqli_fetch_assoc($exec)) :
                    if($res['id_kelas'] == $angkatan['id_kelas']){
                            $selected = 'selected';
                        }else {
                            $selected="";
                        }
                        echo "<option $selected value=".$angkatan['id_kelas'].">".$angkatan['nama_kelas']."</option>";
                endwhile;
                 ?>
            </select>
            <textarea class="form-control mt-2" name="alamat" placeholder="Alamat Siswa"><?= $res['alamat'] ?></textarea>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="Submit" name="edit" class="btn btn-primary">Simpan</button>
        </form>

<?php } ?>
       
        <?php

        if(isset($_POST['id_kelas'])) {
            $id_kelas = $_POST['id_kelas'];
            $exec = mysqli_query($conn,"SELECT * FROM kelas WHERE id_kelas = '$id_kelas'");
            $res = mysqli_fetch_assoc($exec);
            ?>
                <form action="editdatakelas.php" method="POST">
                    <input type="hidden" name="id_kelas" value="<?= $res['id_kelas'] ?>">
                    <input type="text" name="nama_kelas" class="form-control" value="<?= $res['nama_kelas'] ?>">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="Submit" name="edit" class="btn btn-primary">Simpan</button>

                </form>
        <?php }
        if(isset($_POST['id_angkatan'])) {
            $id_angkatan= $_POST['id_angkatan'];
            $exec = mysqli_query($conn,"SELECT * FROM angkatan WHERE id_angkatan = '$id_angkatan'");
            $res = mysqli_fetch_assoc($exec);
            ?>
                <form action="editdataangkatan.php" method="POST">
                    <input type="hidden" name="id_angkatan" value="<?= $res['id_angkatan'] ?>">
                    <input type="text" name="nama_angkatan" class="form-control" value="<?= $res['nama_angkatan'] ?>">
                    <input type="text" name="biaya" class="form-control" value="<?= $res['biaya'] ?>">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="Submit" name="edit" class="btn btn-primary">Simpan</button>

                </form>
        <?php }

         ?>



         <?php 
         if(isset($_POST['id_admin'])) {
            $id_admin = $_POST['id_admin'];
            $exec = mysqli_query($conn,"SELECT * FROM admin WHERE id_admin = '$id_admin'");
            $res = mysqli_fetch_assoc($exec);
            ?>
                <form action="editdataadmin.php" method="POST">
                    <input type="hidden" name="id_admin" value="<?= $res['id_admin'] ?>">
                    <input type="text" name="nama_admin" class="form-control mb-2" value="<?= $res['nama_admin'] ?>">
                    <input type="text" name="user_admin" class="form-control mb-2" value="<?= $res['user_admin'] ?>">
                    <input type="text" name="pass_admin" class="form-control mb-2" value="<?= $res['pass_admin'] ?>">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="Submit" name="edit" class="btn btn-primary">Simpan</button>

                </form>
        <?php }


          ?>
