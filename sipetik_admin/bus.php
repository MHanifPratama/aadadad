<?php
    require_once "sidebar.php";
    require "function.php";
$data_bus = mysqli_query($conn,"SELECT * FROM bus");
$data_tipe = mysqli_query($conn,"SELECT * FROM tipe_bus");
$data_supir = mysqli_query($conn,"SELECT * FROM supir");
$data_tipe1 = mysqli_query($conn,"SELECT * FROM tipe_bus");
$data_supir1 = mysqli_query($conn,"SELECT * FROM supir");
$data_perjalanan = mysqli_query($conn,"SELECT * FROM perjalanan");
$data_perjalanan1 = mysqli_query($conn,"SELECT * FROM perjalanan");
$data_jadwal = mysqli_query($conn,"SELECT * FROM jadwal");
$data_jadwal1 = mysqli_query($conn,"SELECT * FROM jadwal");

if(isset($_POST["kirim_bus"])){
    if(tambah_data_bus($_POST)>0){
        // echo "<script>
        //         alert('Bus Berhasil Ditambahkan!');
        //         </script>";
        // header("Location: bus.php");
        // exit();
        echo '<script>
            alert("Data Berhasil Di Tambah")
            window.location = "bus.php";
            </script>';   
    }
    else{
        echo mysqli_error($conn);
    }
}
if(isset($_POST["kirim_perubahan"])){
    if(ubah_data_bus($_POST)>0){
        echo '<script>
            alert("Data Berhasil Di Ubah")
            window.location = "bus.php";
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
                        <th>No </th>
                        <th>Id Bus</th>
                        <th>Nama Bus</th>
                        <th>id tipe</th>
                        <th>id supir</th>
                        <th>id perjalanan</th>
                        <th>id jadwal</th>
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
                                <?= $ambil['id_tipe'] ?>
                            </td>
                            <td>
                                <?= $ambil['id_supir'] ?>
                            </td>
                            <td>
                                <?= $ambil['id_perjalanan'] ?>
                            </td>
                            <td>
                                <?= $ambil['id_jadwal'] ?>
                            </td>
                            <td>
                            <a class="btn btn-danger btn-lg" href="hapus_bus.php?id=<?=$ambil["id_bus"];?>" onclick="return confirm('Apakah Ingin Menghapus Data ini ?')">Hapus</a>
                            <a class="btn btn-warning btn-lg" id="tombolUbah" data-bs-toggle="modal" data-bs-target="#ubah" data-id_jadwal="<?=$ambil["id_jadwal"];?>" data-id_perjalanan="<?=$ambil["id_perjalanan"];?>"  data-id_tipe="<?=$ambil["id_tipe"];?>" data-id_supir="<?=$ambil["id_supir"];?>" data-nama="<?=$ambil["nama_bus"];?>" data-id="<?=$ambil["id_bus"];?>">Ubah</button>                                
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
                        <h4 class="modal-title">Tambah Bus </h4>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <form method="POST">
                        <div class="modal-body">
                            <input type="text" id="namaBus" name="namaBus" placeholder="Nama Bus" class="form-control"required>
                            <div class="form-group">
                            <label for="exampleFormControlSelect1">Pilih Supir</label>
                            <select class="form-control" name="Category_supir" id="Category_supir">
                            <?php 

                                while ($category_supir = mysqli_fetch_array($data_supir,MYSQLI_ASSOC)):; 
                                ?>
                                    <option value="<?php echo $category_supir["id_supir"];

                                ?>">
                                    <?php echo $category_supir["nama_supir"];
   
                                    ?>
                                </option>
                            <?php 
                                endwhile; 
  
                            ?>
                            </select>
                            <label for="exampleFormControlSelect1">Pilih Tipe Bus</label>
                            <select class="form-control" name="Category_tipe" id="Category_tipe">
                            <?php 

                                while ($category_tipe = mysqli_fetch_array($data_tipe,MYSQLI_ASSOC)):; 
                                ?>
                                    <option value="<?php echo $category_tipe["id_tipe"];

                                ?>">
                                    <?php echo $category_tipe["nama_tipe"];

                                    ?>
                                </option>
                            <?php 
                                endwhile; 

                            ?>
                            </select>
                            <label for="exampleFormControlSelect1">Pilih Perjalanan</label>
                            <select class="form-control" name="Category_perjalanan" id="Category_perjalanan">
                            <?php 

                                while ($category_perjalanan = mysqli_fetch_array($data_perjalanan,MYSQLI_ASSOC)):; 
                                ?>
                                    <option value="<?php echo $category_perjalanan["id_perjalanan"];

                                ?>">
                                    <?php echo $category_perjalanan["kota_awal"];
                                    echo ' - ';
                                    echo $category_perjalanan["kota_akhir"];
                                    ?>
                                </option>
                            <?php 
                                endwhile;  

                            ?>
                            </select>
                            <label for="exampleFormControlSelect1">Pilih Perjalanan</label>
                            <select class="form-control" name="Category_jadwal" id="Category_jadwal">
                            <?php 

                                while ($category_jadwal = mysqli_fetch_array($data_jadwal,MYSQLI_ASSOC)):; 
                                ?>
                                    <option value="<?php echo $category_jadwal["id_jadwal"];

                                ?>">
                                    <?php echo $category_jadwal["tanggal"];
                                    echo ' - ';
                                    echo $category_jadwal["jam"];
                                    ?>
                                </option>
                            <?php 
                                endwhile;  

                            ?>
                            </select>
                        </div> 
                        </div>
                        <button id="kirim_bus"name="kirim_bus" type="submit" class="btn btn-primary btn-lg btn-block">Kirim</button>
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
                            <input type="hidden" name="id_bus_html" id="id_bus_html">
                            <input type="text" id="namaBus" name="namaBus" placeholder="Nama Bus" class="form-control"required>
                            <div class="form-group">
                            <label for="exampleFormControlSelect2">Pilih Supir</label>
                            <select class="form-control" name="Category_supir_edit" id="Category_supir_edit">
                            <?php 
                                while ($category_supir_edit = mysqli_fetch_array($data_supir1,MYSQLI_ASSOC)):; 
                                ?>
                                    <option value="<?php echo $category_supir_edit["id_supir"];
                                    // The value we usually set is the primary key
                                ?>">
                                    <?php echo $category_supir_edit["nama_supir"];
                                        // To show the category name to the user
                                    ?>
                                </option>
                            <?php 
                                endwhile; 
                                // While loop must be terminated
                            ?>
                            </select>
                            <label for="exampleFormControlSelect2">Pilih Tipe Bus</label>
                            <select class="form-control" name="Category_tipe_edit" id="Category_tipe_edit">
                            <?php 
                                // use a while loop to fetch data 
                                // from the $all_categories variable 
                                // and individually display as an option
                                while ($category_tipe_edit = mysqli_fetch_array($data_tipe1,MYSQLI_ASSOC)):; 
                                ?>
                                    <option value="<?php echo $category_tipe_edit["id_tipe"];
                                    // The value we usually set is the primary key
                                ?>">
                                    <?php echo $category_tipe_edit["nama_tipe"];
                                        // To show the category name to the user
                                    ?>
                                </option>
                            <?php 
                                endwhile; 
                                // While loop must be terminated
                            ?>
                            </select>
                            <label for="exampleFormControlSelect2">Pilih Perjalanan</label>
                            <select class="form-control" name="Category_edit_perjalanan" id="Category_edit_perjalanan">
                            <?php 
                                while ($category_perjalanan_edit = mysqli_fetch_array($data_perjalanan1,MYSQLI_ASSOC)):; 
                                ?>
                                    <option value="<?php echo $category_perjalanan_edit["id_perjalanan"];
                                    // The value we usually set is the primary key
                                ?>">
                                    <?php echo $category_perjalanan_edit["kota_awal"];
                                    echo ' - ';
                                    echo $category_perjalanan_edit["kota_akhir"];
                                    ?>
                                </option>
                            <?php 
                                endwhile; 
                                // While loop must be terminated
                            ?>
                            </select>
                            <label for="exampleFormControlSelect2">Pilih Jadwal</label>
                            <select class="form-control" name="Category_edit_jadwal" id="Category_edit_jadwal">
                            <?php 

                                while ($category_edit_jadwal = mysqli_fetch_array($data_jadwal1,MYSQLI_ASSOC)):; 
                                ?>
                                    <option value="<?php echo $category_edit_jadwal["id_jadwal"];

                                ?>">
                                    <?php echo $category_edit_jadwal["tanggal"];
                                    echo ' - ';
                                    echo $category_edit_jadwal["jam"];
                                    ?>
                                </option>
                            <?php 
                                endwhile;  

                            ?>
                            </select>
                        </div> 
                        </div>
                        <button id="kirim_perubahan"name="kirim_perubahan" type="submit" class="btn btn-primary btn-lg btn-block">Kirim</button>
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
            let id_supir = $(this).data('id_supir');
            let id_tipe = $(this).data('id_tipe');
            let id_perjalanan = $(this).data('id_perjalanan');
            let id_jadwal = $(this).data('id_jadwal');
            $(".modal-body #id_bus_html").val(id);
            $(".modal-body #namaBus").val(nama);
            $(".modal-body #Category_tipe_edit").val(id_tipe);
            $(".modal-body #Category_supir_edit").val(id_supir);
            $(".modal-body #Category_edit_perjalanan").val(id_perjalanan);
            $(".modal-body #Category_edit_jadwal").val(id_jadwal);
        });
    </script>