<?php
session_start();
if(isset($_SESSION['login_admin'])){
  header('Location: supir.php');
  exit;
}
require 'function.php';
if (isset($_POST["login_admin"])){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result = mysqli_query($conn,"SELECT * FROM akun_admin WHERE email = '$email'");
    if(mysqli_num_rows($result)===1){

      $row = mysqli_fetch_assoc($result);
      // if($password=== $row["password"]){
      //   header("Location: index.php");
      //   exit;
      // }
       if(password_verify($password,$row["password"])){
          $_SESSION["login_admin"] = true;
          echo '<script>
            alert("Berhasil Login!")
            window.location = "supir.php";
            </script>';

        }
        else{
            echo "<script>
                alert('Password Salah');
                </script>";
        }
        
    }
    else{
      echo "<script>
          alert('Email dan Password Salah');
          </script>";
  }

}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="edit.css">
        <title>Hello, world!</title>
      </head>
      <body>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <nav class="navbar navbar-light fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Login Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Daftar Tabel</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Login Admin</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="register_admin.php">Register Admin</a>
                </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <section class="vh-100">
        <div class="container py-5 h-100">
          <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-8 col-lg-7 col-xl-6">
              <!-- <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                class="img-fluid" alt="Phone image"> -->
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
              
            <form action="" method="post">
                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input name="email" type="email" id="email" class="form-control form-control-lg" />
                  <label class="form-label" for="email">Email address</label>
                </div>
      
                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input name="password" type="password" id="password" class="form-control form-control-lg" />
                  <label class="form-label" for="password">Password</label>
                </div>
      
                <div class="d-flex justify-content-around align-items-center mb-4">
                  <!-- Checkbox -->
                  <a href="register_admin.php">Belum Punya Akun?</a>
                </div>
                
      
                <!-- Submit button -->
                <button name="login_admin" id="login_admin" type="login" class="btn btn-primary btn-lg btn-block">Sign in</button>
              </form>
            </div>
          </div>
        </div>
      </section>
   
    
</body>
</html>