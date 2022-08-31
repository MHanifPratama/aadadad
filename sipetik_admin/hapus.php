<?php
require 'function.php';
$id=$_GET["id"];
var_dump($id);
if(hapus($id)>0){
    echo "<script>
        alert('Data Berhasil Dihapus');
        document.location.href = 'supir.php';
        </script>";
}
else{
    echo "<script>
        alert('Data Tidak Berhasil Dihapus');
        document.location.href = 'supir.php';
        </script>";
}
?>