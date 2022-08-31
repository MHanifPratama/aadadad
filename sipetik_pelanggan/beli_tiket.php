<?php
session_start();
if(!isset($_SESSION['login'])){
  header('Location: login.php');
  exit;
}
require "function.php";
$tanggal = date("Y-m-d");
$data_bus = mysqli_query($conn,"SELECT * FROM bus, tipe_bus,perjalanan,jadwal where bus.id_tipe = tipe_bus.id_tipe AND bus.id_perjalanan = perjalanan.id_perjalanan AND bus.id_jadwal = jadwal.id_jadwal AND jadwal.tanggal >'$tanggal'");
$data_bus1 = mysqli_query($conn,"SELECT * FROM bus, tipe_bus,perjalanan,jadwal where bus.id_tipe = tipe_bus.id_tipe AND bus.id_perjalanan = perjalanan.id_perjalanan AND bus.id_jadwal = jadwal.id_jadwal AND jadwal.tanggal >'$tanggal'  GROUP BY kota_awal,kota_akhir ");

if(isset($_POST["cari"])){
  $data_bus = cari_perjalanan($_POST["Category_perjalanan"]);
}
if(isset($_POST["reset"])){
  $data_bus = reset_perjalanan($_POST["Category_perjalanan"]);
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
        <title>Beli Tiket SIPETIK</title>
      </head>
      <body>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <nav class="navbar navbar-light fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Beli Tiket</a>
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
                    <a class="nav-link active" href="beli_tiket.php">Pesan Tiket Bus</a>
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
    <section class="vh-100">
        <div class="container py-5 h-100">
          <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-8 col-lg-7 col-xl-6">
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No </th>
                        <th>Id Bus</th>
                        <th>Nama Bus</th>
                        <th>Nama tipe</th>
                        <th>Nama Perjalanan</th>
                        <th>Jadwal Keberangkatan</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    $no = 1;
                    foreach ($data_bus as $ambil) : ?>
                        <tr>
                            <td>
                                <?= $no++; ?>
                            </td>
                            <td>
                                <?= $ambil['id_bus'] ?>
                            </td>
                            <td>
                                <?= $ambil['nama_bus'] ?>
                            </td>
                            <td>
                                <?= $ambil['nama_tipe'] ?>
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
                                <?php $harga1 = $ambil['harga']; ?>
                                <?php $harga2 = $ambil['total_km']; ?>
                                <?php $total = $harga1*$harga2; ?>
                                <?php echo  $total ;?>
                            </td>
                            <td>
                            <a class="btn btn-primary btn-lg" href="isi_data_tiket_bus.php?id=<?=$ambil["id_bus"];?>" onclick="return confirm('Apakah Ingin Membeli Tiket ini ?')">Beli</a>               
                        </td>
                        </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
              
            <form action="" method="POST">
                <div class="form-outline mb-4">
                <label class="form-label" for="nama">Masukan Tujuan Perjalanan anda</label>
                <select class="form-control" name="Category_perjalanan" id="Category_perjalanan">
                            <?php $a = 0;
                                while ($category_perjalanan = mysqli_fetch_array($data_bus1,MYSQLI_ASSOC)):; 
                                ?>
                                    <option value="<?php echo $category_perjalanan["id_perjalanan"]; ?>">
                                    <?php echo $category_perjalanan["kota_awal"];
                                    echo ' - ';
                                    echo $category_perjalanan["kota_akhir"];
                                    $a = $category_perjalanan["id_perjalanan"];  
                                  ?>
                                </option>
                            <?php 
                                endwhile;  

                            ?>
                            </select>
                </div>
                <button name="cari" id="cari" type="submit" class="btn btn-primary btn-lg btn-block">Cari Perjalanan</button>
                <button name="reset" id="reset" type="submit" class="btn btn-danger btn-lg btn-block">Reset Perjalanan</button>
              </form>
            </div>
          </div>
        </div>
      </section>
</body>
</html>