<?php

$conn = mysqli_connect("localhost","root","","sipetik");


function jenggot(){
   global $conn;
   $tempA = mysqli_query($conn,"SELECT id_staff FROM akun_staff ORDER BY id_staff DESC LIMIT 1");
   foreach ($tempA as $ambil) : 
      $a = $ambil["id_staff"];
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
     $temp = mysqli_query($conn,"SELECT username FROM akun_staff WHERE username = '$username'");
     $temp_email = mysqli_query($conn,"SELECT email FROM akun_staff WHERE email = '$email'");
     
     
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
     mysqli_query($conn,"INSERT INTO akun_staff VALUES ('','$email','$username','$password')");
     return mysqli_affected_rows($conn);
 }

function tambah_data_laporan($data){
   global $conn;
   $tanggal = date('Y-m-d',strtotime($data["tanggal"]));
   $data_bus = mysqli_query($conn,"SELECT * FROM tiket,bus, tipe_bus,perjalanan,jadwal where tiket.id_bus = bus.id_bus AND bus.id_tipe = tipe_bus.id_tipe AND bus.id_perjalanan = perjalanan.id_perjalanan AND bus.id_jadwal = jadwal.id_jadwal AND jadwal.tanggal = '$tanggal'");
   $data = mysqli_query($conn,"SELECT COUNT(bus.id_bus) AS num FROM tiket,bus, tipe_bus,perjalanan,jadwal where tiket.id_bus = bus.id_bus AND bus.id_tipe = tipe_bus.id_tipe AND bus.id_perjalanan = perjalanan.id_perjalanan AND bus.id_jadwal = jadwal.id_jadwal AND jadwal.tanggal = '$tanggal'");
   $row = mysqli_fetch_assoc($data);
   $numUsers = 0;
   $numUsers = $row['num'];
   $a = 0;
foreach ($data_bus as $ambil) : 
   $harga1 = $ambil['harga']; 
   $harga2 = $ambil['total_km']; 
   $total = $harga1*$harga2; 
   $a = $total + $a;
endforeach;       
   if (empty($tanggal)) {
       echo "<script>
       alert('Mohon masukan data');
       </script>";
       return false;
     }
   mysqli_query($conn,"INSERT INTO laporan VALUES ('','$tanggal','$numUsers','$a')");
   return mysqli_affected_rows($conn);
}

function update_rekap($data){
   global $conn;
   $id = $data["id_laporan"];
   $tanggal = date('Y-m-d',strtotime($data["tanggal"]));
   $data_bus = mysqli_query($conn,"SELECT * FROM tiket,bus, tipe_bus,perjalanan,jadwal where tiket.id_bus = bus.id_bus AND bus.id_tipe = tipe_bus.id_tipe AND bus.id_perjalanan = perjalanan.id_perjalanan AND bus.id_jadwal = jadwal.id_jadwal AND jadwal.tanggal = '$tanggal'");
   $data_aa = mysqli_query($conn,"SELECT COUNT(bus.id_bus) AS num FROM tiket,bus, tipe_bus,perjalanan,jadwal where tiket.id_bus = bus.id_bus AND bus.id_tipe = tipe_bus.id_tipe AND bus.id_perjalanan = perjalanan.id_perjalanan AND bus.id_jadwal = jadwal.id_jadwal AND jadwal.tanggal = '$tanggal'");
   $row = mysqli_fetch_assoc($data_aa);
   $numUsers = 0;
   $numUsers = $row['num'];
   $a = 0;
   foreach ($data_bus as $ambil) : 
      $harga1 = $ambil['harga']; 
      $harga2 = $ambil['total_km']; 
      $total = $harga1*$harga2; 
      $a = $total + $a;
   endforeach;  
   mysqli_query($conn,"UPDATE laporan SET total_tiket = '$numUsers',total_harga = '$a' WHERE id_laporan = $id");
   return mysqli_affected_rows($conn);
}
?>