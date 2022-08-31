<?php
session_start();
if(!isset($_SESSION['login'])){
  header('Location: login.php');
  exit;
}
$akun =  $_SESSION['login'];
require 'function.php';
$data_profile = mysqli_query($conn,"SELECT * FROM akun_user, pelanggan where akun_user.id_akun = pelanggan.id_akun AND pelanggan.id_pelanggan = akun_user.id_pelanggan AND pelanggan.id_akun = '$akun'");

if(isset($_POST["kirim"])){
    if(update_data_profile($_POST)>0){
        // echo "<script>
        //         alert('Berhasil Ditambahkan!');
        //         </script>";
        // header("Location: profile.php");
        // exit();
        echo '<script>
            alert("Berhasil mengupdate profile")
            window.location = "profile.php";
            </script>';
        
                
    }
    else{
        echo mysqli_error($conn);
    }
}
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <!-- Required meta tags -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="edit.css">
        <title>Profile SIPETIK</title>
      </head>
      <body>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <nav class="navbar navbar-light fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Profile</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Daftar Tabel</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="beli_tiket.php">Pesan Tiket Bus</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="lihat_tiket.php">Lihat Tiket</a>
                  </li>
                <li class="nav-item">
                  <a class="nav-link active" href="profile.php">Akun</a>
                </li>

                  <li class="nav-item">
                    <a class="nav-link" href="logout.php">Log Out</a>
                  </li>
              </ul>
          </div>
        </div>
      </div>
    </nav>
    <section class="vh-100">
        <div class="container py-5 h-100">
          <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <?php
                    foreach ($data_profile as $ambil) : ?>
                                <?php $tmp = $ambil['id_pelanggan']; ?>
                                <?php $namaPelanggan = $ambil['nama_pelanggan']; ?>
                                <?php $hpPelanggan = $ambil['nomor_hp_pelanggan']; ?>
                                <?php $ambil['id_akun']?>
                        <?php endforeach; ?>
            </table>
            
            <form action="" method="POST">
                <div class="form-outline mb-4">
                <input name="id" id="id" type="hidden" value="<?= $tmp ?>" class="form-control" >
                <label class="form-label" for="nama">Nama Anda</label>
                <input name="nama" id="nama" type="text" value="<?= $namaPelanggan ?>" class="form-control" >
                <label class="form-label" for="nama">Nomor HP Anda</label>
                <input name="hp" id="hp" type="number" value="<?= $hpPelanggan ?>" class="form-control" >
                </div>
                <button name="kirim" id="kirim" type="submit" class="btn btn-dark btn-lg btn-block">Update Profile</button>
              </form>
            </div>
          </div>
        </div>
      </section>
</body>
</html>