<?php
require 'function.php';
$id=$_GET["id"];
if(hapus_tipe($id)>0){
    echo "<script>
        alert('Data Berhasil Dihapus');
        document.location.href = 'tipe_bus.php';
        </script>";
}
else{
    echo "<script>
        alert('Data Tidak Berhasil Dihapus');
        document.location.href = 'tipe_bus.php';
        </script>";
}
?>