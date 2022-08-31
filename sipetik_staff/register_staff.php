<?php
require 'function.php';
session_start();
if(isset($_SESSION['login_staff'])){
  header('Location: index_staff.php');
  exit;
}
if(isset($_POST["register"])){
    if(registrasi($_POST)>0){
        // echo "<script>
        //         alert('user baru berhasil teregistrasi!');
        //         </script>";
        // header("Location: login_staff.php");
        // exit();
        echo '<script>
            alert("Berhasil teregistrasi!")
            window.location = "login_staff.php";
            </script>';
                
    }
    else{
        echo mysqli_error($conn);
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
        <a class="navbar-brand" href="#">Register Staff</a>
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
                <a class="nav-link active" aria-current="page" href="#">Akun</a>
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
                  <input type="email" name="email" id="email" class="form-control form-control-lg" />
                  <label class="form-label" for="email">Email address</label>
                </div>

                <div class="form-outline mb-4">
                    <input type="text" name ="username" id="username" class="form-control form-control-lg" />
                    <label class="form-label" for="username">Username</label>
                  </div>
      
                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" name ="password" id="password" class="form-control form-control-lg" />
                  <label class="form-label"  for="password">Password</label>
                </div>

                <div class="form-outline mb-4">
                    <input type="password" name ="confpassword" id="confpassword" class="form-control form-control-lg" />
                    <label class="form-label"  for="confpassword">Confirm Password</label>
                  </div>
      
                <div class="d-flex justify-content-around align-items-center mb-4">
                  <!-- Checkbox -->
                  <a href="login_staff.php">Sudah Punya Akun?</a>
                </div>
                <!-- Submit button -->
                <button type="submit" name="register" class="btn btn-primary btn-lg btn-block">Sign in</button>
              </form>
            </div>
          </div>
        </div>
      </section>
   
    
</body>
</html>