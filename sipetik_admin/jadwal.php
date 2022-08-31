<?php
    require_once "sidebar.php";
    require "function.php";
$data_jadwal = mysqli_query($conn,"SELECT * FROM jadwal ORDER BY id_jadwal DESC");

if(isset($_POST["kirim_jadwal"])){
    if(tambah_data_jadwal($_POST)>0){
        // echo "<script>
        //         alert('Bus Berhasil Ditambahkan!');
        //         </script>";
        // header("Location: jadwal.php");
        // exit();
        echo '<script>
            alert("Data Berhasil Di Tambah")
            window.location = "jadwal.php";
            </script>';
                
    }
    else{
        echo mysqli_error($conn);
    }
}

if(isset($_POST["ubah_jadwal"])){
    if(ubah_data_jadwal($_POST)>0){
        // echo "<script>
        //         alert('user baru berhasil diubah!');
        //         </script>";
        // header("Location: jadwal.php");
        // exit();
        echo '<script>
            alert("Data Berhasil Di Ubah")
            window.location = "jadwal.php";
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
                        <th>Id Jadwal</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data_jadwal as $ambil) : ?>
                        <tr>
                            <td>
                                <?= $no++; ?>
                            </td>
                            <td>
                                <?= $ambil['id_jadwal'] ?>
                            </td>
                            <td>
                                <?= $ambil['tanggal'] ?>
                            </td>
                            <td>
                                <?= $ambil['jam'] ?>
                            </td>
                            <td>
                            <a class="btn btn-danger btn-lg" href="hapus_jadwal.php?id=<?=$ambil["id_jadwal"];?>" onclick="return confirm('Apakah Ingin Menghapus Data ini ?')">Hapus</a>
                            <a class="btn btn-warning btn-lg" id="tombolUbah" data-bs-toggle="modal" data-bs-target="#ubah" data-tanggal="<?=$ambil["tanggal"];?>"  data-jam="<?=$ambil["jam"];?>" data-id="<?=$ambil["id_jadwal"];?>">Ubah</button>                                
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
                        <h4 class="modal-title">Tambah Jadwal </h4>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <form method="POST">
                            <div class="modal-body">
                                <input type="date" id="tanggal" name="tanggal" placeholder="Tanggal" class="form-control"required>
                                <input type="time" id="jam" name="jam" placeholder="Jam" class="form-control"required>
                            </div>
                            <button id="kirim_jadwal"name="kirim_jadwal" type="submit" class="btn btn-primary btn-lg btn-block">Kirim</button>
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
                        <h4 class="modal-title">Ubah Jadwal </h4>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <form method="POST">
                            <div class="modal-body">
                                <input type="hidden" name="id_jadwal" id="id_jadwal">
                                <input type="date" id="tanggal" name="tanggal" placeholder="Tanggal" class="form-control"required>
                                <input type="time" id="jam" name="jam" placeholder="Kota Akhir" class="form-control"required>
                            </div>
                            <button id="ubah_jadwal"name="ubah_jadwal" type="submit" class="btn btn-primary">Kirim</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </form>
                    
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        
    <script>
        $(document).on("click","#tombolUbah",function(){
            let id_jadwal = $(this).data('id');
            let jam = $(this).data('jam');
            let tanggal = $(this).data('tanggal');
            $(".modal-body #id_jadwal").val(id_jadwal);
            $(".modal-body #jam").val(jam);
            $(".modal-body #tanggal").val(tanggal);
        });
    </script>