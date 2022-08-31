<?php
    require_once "sidebar.php";
    require "function.php";
$data_info = mysqli_query($conn,"SELECT * FROM info");

if(isset($_POST["kirim_info"])){
    if(tambah_data_info($_POST)>0){
        echo "<script>
                alert('Bus Berhasil Ditambahkan!');
                </script>";
        header("Location: index_admin.php");
        exit();
                
    }
    else{
        echo mysqli_error($conn);
    }
}

if(isset($_POST["ubah_info"])){
    if(ubah_data_info($_POST)>0){
        echo "<script>
                alert('user baru berhasil diubah!');
                </script>";
        header("Location: index_admin.php");
        exit();
                
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
                        <th>Id Info</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    $no = 1;
                    foreach ($data_info as $ambil) : ?>
                        <tr>
                            <td>
                                <?= $no++; ?>
                            </td>
                            <td>
                                <?= $ambil['id_info'] ?>
                            </td>
                            <td>
                                <?= $ambil['judul'] ?>
                            </td>
                            <td>
                                <?= $ambil['deskripsi'] ?>
                            </td>
                            <td>
                            <a class="btn btn-danger btn-lg" href="hapus_info.php?id=<?=$ambil["id_info"];?>" onclick="return confirm('Apakah Ingin Menghapus Data ini ?')">Hapus</a>
                            <a class="btn btn-warning btn-lg" id="tombolUbah" data-bs-toggle="modal" data-bs-target="#ubah" data-judul="<?=$ambil["judul"];?>"  data-deskripsi="<?=$ambil["deskripsi"];?>" data-id="<?=$ambil["id_info"];?>">Ubah</button>                                
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
                        <h4 class="modal-title">Tambah Supir </h4>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <form method="POST">
                            <div class="modal-body">
                                <input type="text" id="judul" name="judul" placeholder="Judul" class="form-control"required>
                                <input type="text" id="deskripsi" name="deskripsi" placeholder="Deskripsi" class="form-control"required>
                            </div>
                            <button id="kirim_info"name="kirim_info" type="submit" class="btn btn-primary btn-lg btn-block">Kirim</button>
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
                        <h4 class="modal-title">Ubah Bus </h4>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <form method="POST">
                            <div class="modal-body">
                                <input type="hidden" name="id_info" id="id_info">
                                <input type="text" id="judul" name="judul" placeholder="Judul" class="form-control"required>
                                <input type="text" id="deskripsi" name="deskripsi" placeholder="Deskripsi" class="form-control"required>
                            </div>
                            <button id="ubah_info"name="ubah_info" type="submit" class="btn btn-primary btn-lg btn-block">Kirim</button>
                    </form>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        
    <script>
        $(document).on("click","#tombolUbah",function(){
            let id_info = $(this).data('id');
            let deskripsi = $(this).data('deskripsi');
            let judul = $(this).data('judul');
            $(".modal-body #id_info").val(id_info);
            $(".modal-body #deskripsi").val(deskripsi);
            $(".modal-body #judul").val(judul);
        });
    </script>
