<?php
session_start();
include 'header.php'; 
include 'koneksi.php';

// Hapus Data Admin
if(isset($_GET['id_admin'])){
    $id_admin = $_GET['id_admin'];
    $exec = mysqli_query($conn,"DELETE FROM admin WHERE id_admin = '$id_admin'");
    if($exec) {
        echo "<script>
        alert('Data admin berhasil dihapus');
        document.location = 'editdataadmin.php';
        </script>";
    } else {
        echo "<script>
        alert('Data admin gagal dihapus');
        document.location = 'editdataadmin.php';
        </script>";
    }
}
?>

<!-- button triger -->
<div class="col-ld-4">
    
<button class="btn btn-primary mb-3 " data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Admin</button>
</div>
<!-- button triger -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Admin</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Admin</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Aksi</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM admin";
                    $exec = mysqli_query($conn,$query);
                    
                    while($res = mysqli_fetch_assoc($exec)) : 
                    ?>
                    <tr>
                        <td align="center"><?= $res['id_admin'] ?></td>
                        <td align="left"><?= $res['nama_admin'] ?></td>
                        <td align="left"><?= $res['user_admin'] ?></td>
                        <td align="left"><?= $res['pass_admin'] ?></td>
                        <td>
                            <a href="editdataadmin.php?id_admin=<?= $res['id_admin'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Yakin Ingin Menghapus Data?')">Hapus</a>
                            <a href="#" class="view_data btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#myModal" id="
                                                <?php echo $res['id_admin']; ?>">Edit</a>
                            <!-- Tambahkan tombol Edit jika diperlukan -->
                        </td>
                    </tr>
                    
                    
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="text" name="nama_admin" placeholder="Nama Lengkap" class="form-control mb-2" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="user_admin" placeholder="Username" class="form-control mb-2" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="pass_admin" placeholder="Password" class="form-control mb-2" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="Submit" name="simpan" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!---Modal edit data siswa--->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body" id="dataadmin">
                
            </div>          
        </div>       
    </div>  
</div>



<?php 
// Tambah Data Admin
if(isset($_POST['simpan'])) {
    $id_admin = $_POST['id_admin'];
    $nama_admin = htmlentities(strip_tags($_POST['nama_admin']));
    $user_admin = htmlentities(strip_tags($_POST['user_admin']));
    $pass_admin = htmlentities(strip_tags($_POST['pass_admin']));
    
    $query = "INSERT INTO admin (id_admin, nama_admin, user_admin, pass_admin) VALUES ('$id_admin','$nama_admin', '$user_admin', '$pass_admin')";
    $exec = mysqli_query($conn, $query);
    if($exec) {
        echo "<script>
        alert('Data admin berhasil disimpan');
        document.location = 'editdataadmin.php';
        </script>";
    } else {
        echo "<script>
        alert('Data admin gagal disimpan');
        document.location = 'editdataadmin.php';
        </script>";
    }
}
?>

<?php include 'footer.php'; ?>



<script type="text/javascript">
    $('.view_data').click(function(){
        var id_admin = $(this).attr('id');
        $.ajax({
            url: 'view.php',
            method: 'post',
            data: {id_admin:id_admin},
            success: function(data){
                $('#dataadmin').html(data)
                $('#myModal').modal('show');
            }
        })
    })
</script>

<?php 
if(isset($_POST['edit'])) {
    $id_admin = $_POST['id_admin'];
    $nama_admin = htmlentities(strip_tags($_POST['nama_admin']));
    $user_admin = htmlentities(strip_tags($_POST['user_admin']));
    $pass_admin = htmlentities(strip_tags($_POST['pass_admin']));

    $query = "UPDATE admin SET 
                                
                                nama_admin = '$nama_admin',
                                user_admin = '$user_admin',
                                pass_admin = '$pass_admin' WHERE id_admin = '$id_admin'";

    $exec = mysqli_query($conn,$query);
    if($exec){
        echo "<script>alert('data admin berhasil diedit')
        document.location = 'editdataadmin.php' </script>";

    }else {
        echo "<script>alert('data admin gagal diedit')
        document.location = 'editdataadmin.php' </script>";
    }
}
 ?>