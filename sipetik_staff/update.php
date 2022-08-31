<?php
require 'function.php';
$id=$_GET["id"];
if(update_rekap($id)>0){
    echo "<script>
        alert('Data Berhasil Diupdate');
        document.location.href = 'rekap.php';
        </script>";

}
else{
    echo "<script>
        alert('Data Tidak Berhasil Diupdate');
        document.location.href = 'rekap.php';
        </script>";
}
?>