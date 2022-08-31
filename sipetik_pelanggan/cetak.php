<?php
session_start();
if(!isset($_SESSION['login'])){
  header('Location: login.php');
  exit;
}
$id=$_GET["id"];
$akun =  $_SESSION['login'];
require 'function.php';
$data_tiket = mysqli_query($conn,"SELECT * FROM tiket,bus, tipe_bus,perjalanan,jadwal where bus.id_tipe = tipe_bus.id_tipe AND bus.id_perjalanan = perjalanan.id_perjalanan AND bus.id_jadwal = jadwal.id_jadwal AND tiket.id_bus = bus.id_bus AND tiket.id_akun = $akun AND id_tiket = $id");

if(isset($_POST["pesan"])){
    if(pesan_tiket_bus($_POST)>0){
        echo "<script>
                alert('Bus Berhasil Ditambahkan!');
                </script>";
        header("Location: isi_data_tiket_bus.php");
        exit();
                
    }
    else{
        echo mysqli_error($conn);
    }
}
                    foreach ($data_tiket as $ambil) : 
                                 $ambil['id_tiket'] ;
                                 $id_bus=$ambil['id_bus'] ;
                                 $nama = $ambil['nama'] ;
                                 $ambil['nama_bus'];
                                 $kota_awal=$ambil['kota_awal'] ;
                                 $kota_akhir=$ambil['kota_akhir'] ;
                                 $tanggal=$ambil['tanggal'] ;
                                 $jam=$ambil['jam'] ;
                                 endforeach; 
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Flight ticket challange</title>
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<!-- INSPO:  https://www.behance.net/gallery/69583099/Mobile-Flights-App-Concept -->
<main class="ticket-system">
   <div class="top">
   <h1 class="title">Mohon Tunggu Sebentar . . . </h1>
   <div class="printer" />
   </div>
   <div class="receipts-wrapper">
      <div class="receipts">
         <div class="receipt">
            <svg class="airliner-logo" viewBox="0 0 403 185" xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="1.414">
               <rect x="35.2925" y="157.459" width="25.8951" height="26.9392" rx="4" fill="black"/>
               <rect x="139.917" y="157.459" width="25.8951" height="26.9392" rx="4" fill="black"/>
               <path d="M6.89148 51.1635V38.8052C6.89148 35.9465 10.19 34.3491 12.4328 36.1216V36.1216C13.0367 36.5989 13.784 36.8586 14.5537 36.8586H21.6141" stroke="black" stroke-width="2"/>
               <rect y="50.9551" width="14.2005" height="29.0275" rx="6" fill="black"/>
               <path d="M194.109 51.1635V38.8052C194.109 35.9465 190.81 34.3491 188.567 36.1216V36.1216C187.963 36.5989 187.216 36.8586 186.446 36.8586H179.386" stroke="black" stroke-width="2"/>
               <rect width="14.2005" height="29.0275" rx="6" transform="matrix(-1 0 0 1 201 50.9551)" fill="black"/>
               <rect x="21.0919" width="158.294" height="163.932" rx="22" fill="black"/>
               <rect x="31.7363" y="34.2422" width="137.423" height="78.7413" rx="17.5" fill="white" stroke="black" stroke-width="5"/>
               <path d="M126.295 133.339C127.131 131.752 148.431 122.306 158.977 117.781C168.166 117.781 166.078 133.339 164.094 136.785C162.11 140.231 144.881 141.692 135.379 142.841C125.878 143.99 125.251 135.323 126.295 133.339Z" fill="white"/>
               <path d="M74.8033 133.339C73.968 131.752 52.6672 122.306 42.1212 117.781C32.9327 117.781 35.021 133.339 37.0049 136.785C38.9888 140.231 56.2173 141.692 65.7192 142.841C75.221 143.99 75.8475 135.323 74.8033 133.339Z" fill="white"/>
               <rect x="34.413" y="31.0723" width="132.07" height="18.8831" rx="9.44156" fill="black" stroke="white" stroke-width="2"/>
               <path d="M79.31 44.077C78.804 44.077 78.3493 43.989 77.946 43.813C77.55 43.6297 77.2383 43.3803 77.011 43.065C76.7837 42.7423 76.6663 42.372 76.659 41.954H77.726C77.7627 42.3133 77.9093 42.6177 78.166 42.867C78.43 43.109 78.8113 43.23 79.31 43.23C79.7867 43.23 80.1607 43.1127 80.432 42.878C80.7107 42.636 80.85 42.328 80.85 41.954C80.85 41.6607 80.7693 41.4223 80.608 41.239C80.4467 41.0557 80.245 40.9163 80.003 40.821C79.761 40.7257 79.4347 40.623 79.024 40.513C78.518 40.381 78.111 40.249 77.803 40.117C77.5023 39.985 77.242 39.7797 77.022 39.501C76.8093 39.215 76.703 38.8337 76.703 38.357C76.703 37.939 76.8093 37.5687 77.022 37.246C77.2347 36.9233 77.5317 36.674 77.913 36.498C78.3017 36.322 78.7453 36.234 79.244 36.234C79.9627 36.234 80.5493 36.4137 81.004 36.773C81.466 37.1323 81.7263 37.609 81.785 38.203H80.685C80.6483 37.9097 80.4943 37.653 80.223 37.433C79.9517 37.2057 79.5923 37.092 79.145 37.092C78.727 37.092 78.386 37.202 78.122 37.422C77.858 37.6347 77.726 37.9353 77.726 38.324C77.726 38.6027 77.803 38.83 77.957 39.006C78.1183 39.182 78.3127 39.3177 78.54 39.413C78.7747 39.501 79.101 39.6037 79.519 39.721C80.025 39.8603 80.432 39.9997 80.74 40.139C81.048 40.271 81.312 40.48 81.532 40.766C81.752 41.0447 81.862 41.426 81.862 41.91C81.862 42.284 81.763 42.636 81.565 42.966C81.367 43.296 81.0737 43.5637 80.685 43.769C80.2963 43.9743 79.838 44.077 79.31 44.077ZM86.756 36.333V44H85.755V36.333H86.756ZM96.0081 38.577C96.0081 39.215 95.7881 39.7467 95.3481 40.172C94.9154 40.59 94.2517 40.799 93.3571 40.799H91.8831V44H90.8821V36.333H93.3571C94.2224 36.333 94.8787 36.542 95.3261 36.96C95.7807 37.378 96.0081 37.917 96.0081 38.577ZM93.3571 39.974C93.9144 39.974 94.3251 39.853 94.5891 39.611C94.8531 39.369 94.9851 39.0243 94.9851 38.577C94.9851 37.631 94.4424 37.158 93.3571 37.158H91.8831V39.974H93.3571ZM100.673 37.147V39.71H103.467V40.535H100.673V43.175H103.797V44H99.6722V36.322H103.797V37.147H100.673ZM112.451 36.333V37.147H110.361V44H109.36V37.147H107.259V36.333H112.451ZM117.104 36.333V44H116.103V36.333H117.104ZM125.388 44L122.231 40.502V44H121.23V36.333H122.231V39.886L125.399 36.333H126.664L123.188 40.172L126.697 44H125.388Z" fill="white"/>
            </svg>
            <div class="route">
               <h2>SIPETIK </h2>
               <!-- <svg class="plane-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 510 510">
               <path d="M402.079 460.5C427.321 460.5 449.982 449.288 465.758 431.75L516.816 431.75C532.592 431.75 545.5 418.813 545.5 403V374.25C545.5 358.437 532.592 345.5 516.816 345.5H488.132L488.132 115.5L516.816 115.5C532.592 115.5 545.5 102.563 545.5 86.75V58C545.5 42.1875 532.592 29.25 516.816 29.25L465.758 29.25C449.982 11.7125 427.321 0.5 402.079 0.5L115.237 0.5C14.8421 0.5 0.5 103.425 0.5 230.5C0.5 357.575 14.8421 460.5 115.237 460.5L402.079 460.5ZM430.763 359.875C430.763 383.737 411.545 403 387.737 403C363.929 403 344.711 383.737 344.711 359.875C344.711 336.013 363.929 316.75 387.737 316.75C411.545 316.75 430.763 336.013 430.763 359.875ZM430.763 101.125C430.763 124.987 411.545 144.25 387.737 144.25C363.929 144.25 344.711 124.987 344.711 101.125C344.711 77.2625 363.929 58 387.737 58C411.545 58 430.763 77.2625 430.763 101.125ZM258.658 58L258.658 403H115.237L115.237 58H258.658Z" fill="black"/>
            </svg>
               <h2>ATL</h2> -->
            </div>
            <div class="details">
               <div class="item">
                  <span>Nama</span>
                  <h3><?= $nama?></h3>
               </div>
               <div class="item">
                  <span>Id Bus</span>
                  <h3><?=$id_bus?></h3>
               </div>
               <div class="item">
                  <span>Jadwal</span>
                  <h3><?= $tanggal?></h3>
               </div>
               <div class="item">
                  <span>Jam</span>
                  <h3><?= $jam?></h3>
               </div>
               <div class="item">
                  <span>Titik Jemput</span>
                  <h3><?= $kota_awal ?></h3>
               </div>
               <div class="item">
                  <span>Tujuan</span>
                  <h3><?= $kota_akhir ?></h3>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
<!-- partial -->
  
</body>
</html>
