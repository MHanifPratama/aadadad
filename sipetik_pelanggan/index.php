<?php
session_start();
include 'function.php';
if(!isset($_SESSION['login'])){
  header('Location: login.php');
  exit;
}
$akun =  $_SESSION['login'];
$data_profile = mysqli_query($conn,"SELECT * FROM akun_user, pelanggan where akun_user.id_akun = pelanggan.id_akun AND pelanggan.id_pelanggan = akun_user.id_pelanggan AND pelanggan.id_akun = '$akun'");

?>
<?php
foreach ($data_profile as $ambil) : 
   $tmp = $ambil['id_pelanggan']; 
   $namaPelanggan = $ambil['nama_pelanggan']; 
   $hpPelanggan = $ambil['nomor_hp_pelanggan']; 
   $ambil['id_akun'];
 endforeach; 
 ?>
<!doctype html>
<html lang="en">
  <head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="edit.css">
  </head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <nav class="navbar navbar-light fixed-top">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">HOME</a>
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
                  <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="beli_tiket.php">Pesan Tiket Bus</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="lihat_tiket.php">Lihat Tiket</a>
                  </li>
                <li class="nav-item">
                  <a class="nav-link" href="profile.php">Akun</a>
                </li>

                  <li class="nav-item">
                    <a class="nav-link" href="logout.php">Log Out</a>
                  </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <section
			class="min-vh-100 d-flex align-items-center py-lg-0 py-5"id="tentang">
			<div class="container">
				<div class="row align-items-center g-5 g-lg-0">
					<div class="col-lg-5 order-lg-1 order-5">
						<img class="my-photo" height="400" src="image/sipetik.svg" alt="JohnDeacon"/>
					</div>
					<div class="col-lg-1 order-lg-2 order-2"></div>
					<div class="col-lg-6 order-lg-3 order-3">
						<h1 class="main-header">Selamat Datang <br/>
						</h1>
            <h1 class=""><b> <?= $namaPelanggan?> </b></h1>
						<p class="my-4 text-content">
						</p>
						<a href="beli_tiket.php" class="btn btn-dark btn-lg">Pesan Tiket</a>
					</div>
				</div>
			</div>
		</section>
  </body>
</html>
© 2022 GitHub, Inc.
Terms
Privacy
Securit