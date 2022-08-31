<?php
// session_start();
// if(!isset($_SESSION['login_admin'])){
//   header('Location: login_admin.php');
//   exit;
// }

    require_once "sidebar.php";
    require "function.php";

    $data_tipe = mysqli_query($conn,"SELECT * FROM tipe_bus");

    if(isset($_POST["kirim_supir"])){
        if(tambah_data_tipe($_POST)>0){
            // echo "<script>
            //         alert('Supir Berhasil Ditambahkan!');
            //         </script>";
            // header("Location: tipe_bus.php");
            // exit();
            echo '<script>
            alert("Data Berhasil Di Tambah")
            window.location = "tipe_bus.php";
            </script>';
                    
        }
        else{
            echo mysqli_error($conn);
        }
    }
    if(isset($_POST["kirim_perubahan"])){
        if(ubah_data_tipe($_POST)>0){
            // echo "<script>
            //         alert('user baru berhasil diubah!');
            //         </script>";
            // header("Location: tipe_bus.php");
            // exit();
            echo '<script>
            alert("Data Berhasil Di Ubah")
            window.location = "tipe_bus.php";
            </script>';
                    
        }
        else{
            echo mysqli_error($conn);
        }
    }
?>
    <!-- DataTales Example -->
    <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4"> 
        <button type="button" class="btn btn-info btn-lg" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Data</button>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Id Tipe</th>
                            <th>Nama Tipe</th>
                            <th>Harga/KM</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        $no = 1;
                        foreach ($data_tipe as $ambil) : ?>
                            <tr>
                                <td>
                                    <?= $no++; ?>
                                </td>
                                <td>
                                    <?= $ambil['id_tipe'] ?>
                                </td>
                                <td>
                                    <?= $ambil['nama_tipe'] ?>
                                </td>
                                <td>
                                    <?= $ambil['harga'] ?>
                                </td>
                                
                                <td>
                                <a class="btn btn-danger btn-lg" href="hapus_tipe.php?id=<?=$ambil["id_tipe"];?>" onclick="return confirm('Apakah Ingin Menghapus Data ini ?')">Hapus</a>
                                <a class="btn btn-warning btn-lg" id="tombolUbah" data-bs-toggle="modal" data-bs-target="#ubah" data-harga="<?=$ambil["harga"];?>" data-nama="<?=$ambil["nama_tipe"];?>" data-id="<?=$ambil["id_tipe"];?>">Ubah</button>                                
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
                            <h4 class="modal-title">Tambah Tipe Bus </h4>
                            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                        </div>
                        <form method="POST">
                            <div class="modal-body">
                                <input type="text" id="namaTipe" name="namaTipe" placeholder="Nama Tipe" class="form-control"required>
                                <input type="number" id="harga" name="harga" placeholder="Harga" class="form-control"required>
                            </div>
                            <button id="kirim_supir"name="kirim_supir" type="submit" class="btn btn-primary btn-lg btn-block">Kirim</button>
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
                            <h4 class="modal-title">Ubah Tipe Bus </h4>
                            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                        </div>
                        <form method="POST">
                            <div class="modal-body">
                                <input type="hidden" name="id_tipe" id="id_tipe">
                                <input type="text" id="namaTipe" name="namaTipe" placeholder="Nama Tipe" class="form-control"required>
                                <input type="number" id="harga" name="harga" placeholder="Harga/KM" class="form-control"required>
                            </div>
                            <button id="kirim_perubahan"name="kirim_perubahan" type="submit" class="btn btn-primary btn-lg btn-block">Ubah</button>
                        </form>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
        <script>
            $(document).on("click","#tombolUbah",function(){
                let id = $(this).data('id');
                let nama = $(this).data('nama');
                let harga = $(this).data('harga');
                $(".modal-body #id_tipe").val(id);
                $(".modal-body #namaTipe").val(nama);
                $(".modal-body #harga").val(harga);
            });
        </script>
