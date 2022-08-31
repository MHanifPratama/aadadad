<?php
    require_once "sidebar.php";
    require "function.php";
$data_bus = mysqli_query($conn,"SELECT * FROM perjalanan ORDER BY id_perjalanan DESC");

if(isset($_POST["kirim_perjalanan"])){
    if(tambah_data_perjalanan($_POST)>0){
        // echo "<script>
        //         alert('Bus Berhasil Ditambahkan!');
        //         </script>";
        // header("Location: perjalanan.php");
        // exit();
        echo '<script>
            alert("Data Berhasil Di Tambah")
            window.location = "perjalanan.php";
            </script>';
                
    }
    else{
        echo mysqli_error($conn);
    }
}

if(isset($_POST["ubah_perjalanan"])){
    if(ubah_data_perjalanan($_POST)>0){
        // echo "<script>
        //         alert('user baru berhasil diubah!');
        //         </script>";
        // header("Location: perjalanan.php");
        // exit();
        echo '<script>
            alert("Data Berhasil Di Ubah")
            window.location = "perjalanan.php";
            </script>';
                
    }
    else{
        echo mysqli_error($conn);
    }
}

?>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

<!-- DataTales Example -->
<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <button type="button" class="btn btn-info btn-lg" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Data</button>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No </th>
                        <th>Id perjalanan</th>
                        <th>Kota Awal</th>
                        <th>Kota Akhir</th>
                        <th>Total KM</th>
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
                                <?= $ambil['id_perjalanan'] ?>
                            </td>
                            <td>
                                <?= $ambil['kota_awal'] ?>
                            </td>
                            <td>
                                <?= $ambil['kota_akhir'] ?>
                            </td>
                            <td>
                                <?= $ambil['total_km'] ?>
                            </td>
                            <td>
                            <a class="btn btn-danger btn-lg" href="hapus_perjalanan.php?id=<?=$ambil["id_perjalanan"];?>" onclick="return confirm('Apakah Ingin Menghapus Data ini ?')">Hapus</a>
                            <a class="btn btn-warning btn-lg" id="tombolUbah" data-bs-toggle="modal" data-bs-target="#ubah" data-total_km="<?=$ambil["total_km"];?>"  data-kota_akhir="<?=$ambil["kota_akhir"];?>" data-kota_awal="<?=$ambil["kota_awal"];?>" data-id="<?=$ambil["id_perjalanan"];?>">Ubah</button>                                
                        </td>
                        </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
</div>
<!-- Modal -->
        <div class="modal fade" id="tambah">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Perjalanan </h4>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <form method="POST">
                            <div class="modal-body">
                                <input type="text" id="kotaAwal" name="kotaAwal" placeholder="Kota Awal" class="form-control"required>
                                <input type="text" id="kotaAkhir" name="kotaAkhir" placeholder="Kota Akhir" class="form-control"required>
                                <input type="number" id="km" name="km" placeholder="Total KM" class="form-control" required> 
                            </div>
                            <button id="kirim_perjalanan"name="kirim_perjalanan" type="submit" class="btn btn-primary btn-lg btn-block">Kirim</button>
                    </form>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="ubah">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Perjalanan Bus </h4>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <form method="POST">
                            <div class="modal-body">
                                <input type="hidden" name="id_bus_html" id="id_bus_html">
                                <input type="text" id="kotaAwal" name="kotaAwal" placeholder="Kota Awal" class="form-control"required>
                                <input type="text" id="kotaAkhir" name="kotaAkhir" placeholder="Kota Akhir" class="form-control"required>
                                <input type="number" id="km" name="km" placeholder="Total KM" class="form-control" required> 
                            </div>
                            <button id="ubah_perjalanan"name="ubah_perjalanan" type="submit" class="btn btn-primary btn-lg btn-block">Kirim</button>
                    </form>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        
    <script>
        $(document).on("click","#tombolUbah",function(){
            let id_perja = $(this).data('id');
            let kota_awal = $(this).data('kota_awal');
            let kota_akhir = $(this).data('kota_akhir');
            let total_km = $(this).data('total_km');
            $(".modal-body #id_bus_html").val(id_perja);
            $(".modal-body #kotaAwal").val(kota_awal);
            $(".modal-body #kotaAkhir").val(kota_akhir);
            $(".modal-body #km").val(total_km);
        });
    </script>