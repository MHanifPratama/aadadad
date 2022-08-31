<?php

$conn = mysqli_connect("localhost","root","","sipetik");


function jenggot(){
   global $conn;
   $tempA = mysqli_query($conn,"SELECT id_akun FROM akun_user ORDER BY id_akun DESC LIMIT 1");
   foreach ($tempA as $ambil) : 
      $a = $ambil["id_akun"];
   endforeach;
   return $a+1;
}
 function query($query){
     global $conn;
     $result = mysqli_query($conn,$query);
     $rows = [];
     while($row = mysqli_fetch_array($result)){
         $rows[] = $row;

     }
     return $rows;
 }
 function registrasi($data){
     global $conn;
     $akun = jenggot();
     
     $email = $data["email"];
     $username = $data["username"];
     $password = mysqli_real_escape_string($conn,$data["password"]);
     $passwordconf = mysqli_real_escape_string($conn,$data["confpassword"]);
     $temp = mysqli_query($conn,"SELECT username FROM akun_user WHERE username = '$username'");
     $temp_email = mysqli_query($conn,"SELECT email FROM akun_user WHERE email = '$email'");
     
     
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
     mysqli_query($conn,"INSERT INTO akun_user VALUES ('','$username','$password','$akun','$email')");
     mysqli_query($conn,"INSERT INTO pelanggan VALUES ('$akun','','','$akun')");
     return mysqli_affected_rows($conn);
 }

 function cari_perjalanan($key){
      $tanggal = date("Y-m-d");
    $a = "SELECT * FROM bus, tipe_bus, perjalanan, jadwal where bus.id_tipe = tipe_bus.id_tipe AND bus.id_perjalanan = perjalanan.id_perjalanan AND bus.id_jadwal = jadwal.id_jadwal AND bus.id_perjalanan = '$key' AND jadwal.tanggal >'$tanggal' ORDER BY id_bus DESC";
    return query($a);
 }
 
 function reset_perjalanan($key){
   $tanggal = date("Y-m-d");
    $a = "SELECT * FROM bus, tipe_bus, perjalanan, jadwal where bus.id_tipe = tipe_bus.id_tipe AND bus.id_perjalanan = perjalanan.id_perjalanan AND bus.id_jadwal = jadwal.id_jadwal AND jadwal.tanggal >'$tanggal' ORDER BY id_bus DESC";
    return query($a);
 }
 function pesan_tiket_bus($data){
    global $conn;
    $id_bus = htmlspecialchars($data["id"]);
    $nama = htmlspecialchars($data["nama"]);
    $harga = htmlspecialchars($data["harga"]);
    $akun = htmlspecialchars($data["akun"]);
    if (empty($harga) || empty($nama) || empty($id_bus)){
        echo "<script>
        alert('Mohon masukan data');
        </script>";
        return false;
      }
      mysqli_query($conn,"INSERT INTO tiket VALUES ('','$id_bus','$nama','$harga','$akun')");
      return 1;
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

 function update_data_profile($data){
   global $conn;
   $id = htmlspecialchars($data["id"]);
   $nama = htmlspecialchars($data["nama"]);
   $hp = htmlspecialchars($data["hp"]);
   mysqli_query($conn,"UPDATE pelanggan SET nama_pelanggan = '$nama',nomor_hp_pelanggan = '$hp' WHERE id_pelanggan = $id");
   return 1;
 }

