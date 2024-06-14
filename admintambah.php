<?php
session_start();
include 'koneksi.php';
include 'header.php';
?>

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <img width="100%" height="100%" src="img/smk3.jpg">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                <div class="text-center">

                                    <h1 class="h4 text-gray-900 mb-4">Tambah Data Admin</h1>    
                                </div>
                                <form class="user" method="post" action="">
                                    <div class="form-group">
                                        
                                        <input type="text" autocomplete="off" required name="nama_admin" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Name...">    
                                    </div>
                                    <div class="form-group">
                                        <input type="text" autocomplete="off" required name="user_admin" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Username...">    
                                    </div>
                                    <div class="form-group">
                                        <input autocomplete="off" type="password"required name="pass_admin" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                        
                                    </div>
                                    <button type="submit" name="simpan" class="btn btn-primary btn-user btn-block">Simpan</button>
                                    <hr>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        
    </div> 
</div>
 
<?php
 if ( isset($_POST['simpan']) ) {
    $user_admin = $_POST['user_admin'];
    $pass_admin = $_POST['pass_admin'];
    $nama_admin = $_POST['nama_admin'];

    $exec = mysqli_query($conn,"INSERT INTO admin(user_admin,pass_admin,nama_admin) Values ('$user_admin','$pass_admin','$nama_admin')");

    if( $exec ){
        echo "
        <script>
        alert('data admin berhasil ditambahkan');
        document.location.href = 'editdataadmin.php';
        </script>
        ";
    }else {
        echo "
        <script>
        alert('data admin gagal ditambahkan');
        document.location.href = 'editdataadmin.php';
        </script>
        ";
    }
 }


?>
</div>
<?php  include 'footer.php';  ?>
