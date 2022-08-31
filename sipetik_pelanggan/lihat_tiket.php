<?php
session_start();
if(!isset($_SESSION['login'])){
  header('Location: login.php');
  exit;
}
$akun =  $_SESSION['login'];
require 'function.php';
$data_tiket = mysqli_query($conn,"SELECT * FROM tiket,bus, tipe_bus,perjalanan,jadwal where bus.id_tipe = tipe_bus.id_tipe AND bus.id_perjalanan = perjalanan.id_perjalanan AND bus.id_jadwal = jadwal.id_jadwal AND tiket.id_bus = bus.id_bus AND tiket.id_akun = $akun ORDER BY id_tiket DESC");

if(isset($_POST["pesan"])){
    if(pesan_tiket_bus($_POST)>0){
        echo "<script>
                alert('Bus Berhasil Ditambahkan!');
                </script>";
        header("Location: isi_data_tiket_bus.php");
        exit();
                
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
        <title>Lihat Tiket SIPETIK</title>
      </head>
      <body>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <nav class="navbar navbar-light fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Lihat Tiket</a>
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
                    <a class="nav-link active" href="lihat_tiket.php">Lihat Tiket</a>
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
    <section class="vh-100">
        <div class="container py-5 h-100">
          <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No </th>
                        <th>Id Tiket</th>
                        <th>Id Bus </th>
                        <th>Nama </th>
                        <th>Nama Bus </th>
                        <th>Perjalanan </th>
                        <th>Waktu </th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data_tiket as $ambil) : ?>
                        <tr>
                            <td>
                                <?= $no++; ?>
                            </td>
                            <td>
                                <?= $ambil['id_tiket'] ?>
                            </td>
                            <td>
                                <?= $ambil['id_bus'] ?>
                            </td>
                            <td>
                                <?= $ambil['nama'] ?>
                            </td>
                            <td>
                                <?= $ambil['nama_bus'] ?>
                            </td>
                            <td>
                                <?= $ambil['kota_awal'] ?>
                                <?php echo " - " ?>
                                <?= $ambil['kota_akhir'] ?>
                            </td>
                            <td>
                                <?= $ambil['tanggal'] ?>
                                <?php echo " - " ?>
                                <?= $ambil['jam'] ?>
                            </td>
                            <td>
                            <a class="btn btn-dark btn-lg" href="cetak.php?id=<?=$ambil["id_tiket"];?>" onclick="return confirm('Apakah Melihat Tiket ini ?')">Lihat</a>   
                            </td>
                        </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
            
            <form action="" method="POST">
                <div class="form-outline mb-4">
                </div>
              </form>
              <a name="pesan" id="pesan" href="beli_tiket.php" class="btn btn-primary btn-lg btn-block">Pesan Tiket</a>
            </div>
          </div>
        </div>
      </section>
</body>
</html>