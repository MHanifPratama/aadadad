<?php
$conn = mysqli_connect("localhost","root","","sipetik");
 function query($query){
     global $conn;
     $result = mysqli_query($conn,$query);
     $rows = [];
     while($rows = mysqli_fetch_array($result)){
         $rows[] = $rows;

     }
     return $rows;
 }
 function registrasi($data){
     global $conn;
     $email = htmlspecialchars( $data["email"]);
     $username = htmlspecialchars($data["username"]);
     $password = mysqli_real_escape_string($conn,$data["password"]);
     $passwordconf = mysqli_real_escape_string($conn,$data["confpassword"]);
     $temp = mysqli_query($conn,"SELECT username FROM akun_admin WHERE username = '$username'");
     $temp_email = mysqli_query($conn,"SELECT email FROM akun_admin WHERE email = '$email'");

     if(mysqli_fetch_assoc($temp_email)){
        echo "<script>
        alert('Email Sudah Ada');
        </script>";
        return false;
     }


     if(mysqli_fetch_assoc($temp)){
        echo "<script>
        alert('Username Sudah Ada');
        </script>";
        return false;
     }
     if($password !== $passwordconf){
         echo "<script>
                    alert('Password Tidak Sesuai');
                    </script>";
        return false;
     }
     $password = password_hash($password,PASSWORD_DEFAULT);
     mysqli_query($conn,"INSERT INTO akun_admin VALUES ('','$username','$password','$email')");
     return mysqli_affected_rows($conn);
 }

 function tambah_data_supir($data){
    global $conn;
    $nama_supir = htmlspecialchars($data["namaSupir"]);
    $telepon_supir = htmlspecialchars( $data["noHp"]);
    if (empty($nama_supir) || empty($telepon_supir)) {
        echo "<script>
        alert('Mohon masukan data');
        </script>";
        return false;
      }
    mysqli_query($conn,"INSERT INTO supir VALUES ('','$nama_supir','$telepon_supir')");
    return mysqli_affected_rows($conn);
 }
 function hapus($id){
     global $conn;
     mysqli_query($conn,"DELETE FROM supir WHERE id_supir = $id");
     return mysqli_affected_rows($conn);
 }

 function hapus_tipe($id){
    global $conn;
    mysqli_query($conn,"DELETE FROM tipe_bus WHERE id_tipe = $id");
    return mysqli_affected_rows($conn);
}
function hapus_bus($id){
    global $conn;
    mysqli_query($conn,"DELETE FROM bus WHERE id_bus = $id");
    return mysqli_affected_rows($conn);
}
function hapus_perjalanan($id){
   global $conn;
   mysqli_query($conn,"DELETE FROM perjalanan WHERE id_perjalanan = $id");
   return mysqli_affected_rows($conn);
}
function hapus_jadwal($id){
   global $conn;
   mysqli_query($conn,"DELETE FROM jadwal WHERE id_jadwal = $id");
   return mysqli_affected_rows($conn);
}
function hapus_info($id){
   global $conn;
   mysqli_query($conn,"DELETE FROM info WHERE id_info = $id");
   return mysqli_affected_rows($conn);
}
//  function kueri ($query){
//      global $conn;
//      $result = mysqli_query($conn,$query);
//      $rows=[];
//      while($row = mysqli_fetch_assoc($result)){
//          $rows[] = $row;
//      }
//      return $rows;
//  }

 function ubah_data_supir($data){
    global $conn;
    $id = htmlspecialchars($data["id_supir_html"]);
    $nama = htmlspecialchars($data["namaSupir"]);
    $telepon_supir = htmlspecialchars( $data["noHp"]);
    mysqli_query($conn,"UPDATE supir SET id_supir = '$id',nama_supir = '$nama',nomor_hp_supir = '$telepon_supir' WHERE id_supir = $id");
    return mysqli_affected_rows($conn);
 }
 function ubah_data_tipe($data){
    global $conn;
    $id_tipe = htmlspecialchars($data["id_tipe"]);
    $nama_tipe = htmlspecialchars($data["namaTipe"]);
    $harga = htmlspecialchars($data["harga"]);
    mysqli_query($conn,"UPDATE tipe_bus SET id_tipe = '$id_tipe',nama_tipe = '$nama_tipe' ,harga = '$harga' WHERE id_tipe = $id_tipe");
    return mysqli_affected_rows($conn);
 }
 function ubah_data_bus($data){
    global $conn;
    $id_bus = ($data["id_bus_html"]);
    $name_bus = htmlspecialchars($data['namaBus']);
    $id_supir = ($data['Category_tipe_edit']); 
    $id_tipe = ($data['Category_supir_edit']); 
    $id_perjalanan = htmlspecialchars($data['Category_edit_perjalanan']); 
    $id_jadwal = htmlspecialchars($data['Category_edit_jadwal']); 
    mysqli_query($conn,"UPDATE bus SET id_bus = '$id_bus',nama_bus = '$name_bus', id_tipe = $id_tipe, id_supir = '$id_supir',id_perjalanan = '$id_perjalanan',id_jadwal = '$id_jadwal' WHERE id_bus = $id_bus");
    return mysqli_affected_rows($conn);
 }

 function ubah_data_perjalanan($data){
   global $conn;
   $id_perjalanan = ($data["id_bus_html"]);
   $kota_awal = htmlspecialchars($data["kotaAwal"]);
   $kota_akhir = htmlspecialchars($data["kotaAkhir"]);
   $total_km = htmlspecialchars($data["km"]);
   mysqli_query($conn,"UPDATE perjalanan SET id_perjalanan = '$id_perjalanan',kota_awal = '$kota_awal', kota_akhir = '$kota_akhir', total_km = '$total_km' WHERE id_perjalanan = '$id_perjalanan'");
   return mysqli_affected_rows($conn);
}
function ubah_data_jadwal($data){
   global $conn;
   $id_jadwal = ($data["id_jadwal"]);
   $tanggal = date('Y-m-d',strtotime($data["tanggal"]));
   $jam = ($data["jam"]);
   mysqli_query($conn,"UPDATE jadwal SET id_jadwal = '$id_jadwal',tanggal = '$tanggal', jam = '$jam' WHERE id_jadwal = '$id_jadwal'");
   return mysqli_affected_rows($conn);
}
function ubah_data_info($data){
   global $conn;
   $id_info = htmlspecialchars($data["id_info"]);
   $judul = htmlspecialchars($data["judul"]);
   $deskripsi = htmlspecialchars($data["deskripsi"]);
   $jam = ($data["jam"]);
   mysqli_query($conn,"UPDATE info SET id_info = '$id_info',judul = '$judul', deskripsi = '$deskripsi' WHERE id_info = '$id_info'");
   return mysqli_affected_rows($conn);
}

 function tambah_data_bus($data){
     global $conn;
    $name = htmlspecialchars($data['namaBus']);
    $id_supir = htmlspecialchars($data['Category_supir']); 
    $id_tipe = htmlspecialchars($data['Category_tipe']); 
    $id_perjalanan = htmlspecialchars($data['Category_perjalanan']); 
    $id_jadwal = htmlspecialchars($data['Category_jadwal']); 
    $sql_insert = "INSERT INTO `bus` VALUES ('','$name','$id_tipe','$id_supir','$id_perjalanan','$id_jadwal')";
    if (empty($name) || empty($id_supir)|| empty($id_tipe)|| empty($id_perjalanan)|| empty($id_jadwal)) {
        echo "<script>
        alert('Mohon masukan data');
        </script>";
        return false;
      }
    mysqli_query($conn,$sql_insert);
    return mysqli_affected_rows($conn);
 }
 
 function tambah_data_tipe($data){
    global $conn;
    $nama_tipe = htmlspecialchars($data["namaTipe"]);
    $harga = htmlspecialchars($data["harga"]);
    if (empty($nama_tipe)) {
        echo "<script>
        alert('Mohon masukan data');
        </script>";
        return false;
      }
    mysqli_query($conn,"INSERT INTO tipe_bus VALUES ('','$nama_tipe','$harga')");
    return mysqli_affected_rows($conn);
 }

 function tambah_data_perjalanan($data){
   global $conn;
   $kota_awal = htmlspecialchars($data["kotaAwal"]);
   $kota_akhir = htmlspecialchars($data["kotaAkhir"]);
   $total_km = htmlspecialchars($data["km"]);

   if (empty($kota_awal)||empty($kota_akhir)||empty($total_km)) {
       echo "<script>
       alert('Mohon masukan data');
       </script>";
       return false;
     }
   mysqli_query($conn,"INSERT INTO perjalanan VALUES ('','$kota_awal','$kota_akhir',$total_km)");
   return mysqli_affected_rows($conn);
}
function tambah_data_jadwal($data){
   global $conn;
   $tanggal = date('Y-m-d',strtotime($data["tanggal"]));
   $jam = ($data["jam"]);

   if (empty($tanggal)||empty($jam)) {
       echo "<script>
       alert('Mohon masukan data');
       </script>";
       return false;
     }
   mysqli_query($conn,"INSERT INTO jadwal VALUES ('','$tanggal','$jam')");
   return mysqli_affected_rows($conn);
}
function tambah_data_info($data){
   global $conn;
   $judul = htmlspecialchars($data["judul"]);
   $deskripsi = htmlspecialchars($data["deskripsi"]);

   if (empty($judul)||empty($deskripsi)) {
       echo "<script>
       alert('Mohon masukan data');
       </script>";
       return false;
     }
   mysqli_query($conn,"INSERT INTO info VALUES ('','$judul','$deskripsi')");
   return mysqli_affected_rows($conn);
}