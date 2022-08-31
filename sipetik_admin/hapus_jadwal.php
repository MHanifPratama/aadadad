<?php
require 'function.php';
$id=$_GET["id"];
var_dump($id);
if(hapus_jadwal($id)>0){
    // echo "<script>
    //     alert('Data Berhasil Dihapus');
    //     document.location.href = 'jadwal.php';
    //     </script>";
    echo '<script>
            alert("Data Berhasil Di Hapus")
            window.location = "jadwal.php";
            </script>';
}
else{
    echo "<script>
        alert('Data Tidak Berhasil Dihapus');
        document.location.href = 'jadwal.php';
        </script>";
}
?>