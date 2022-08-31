<?php
require 'function.php';
$id=$_GET["id"];
var_dump($id);
if(hapus_info($id)>0){
    echo "<script>
        alert('Data Berhasil Dihapus');
        document.location.href = 'index_admin.php';
        </script>";
}
else{
    echo "<script>
        alert('Data Tidak Berhasil Dihapus');
        document.location.href = 'index_admin.php';
        </script>";
}
?>