<?php
session_start();
ob_start();
if(!isset($_SESSION['login_staff'])){
  header('Location: login_staff.php');
  exit();
} 
?>
<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sistem Penjualan Tiket">
        <meta name="author" content="Hanif">
        <title>SIPETIK</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        
        <link href="styles_staff.css" rel="stylesheet">
        <body>
            <!-- Sidebar -->
            <nav class="sidebar d-flex flex-nowrap col-md-3 col-lg-2 d-md-inline bg-primary">
                <div class="d-flex flex-column flex-shrink-0 p-3">
                    <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                        <span class="fs-4 text-lg">SIPETIK</span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <!-- <li class="nav-item">
                            <a href="index_staff.php" class="nav-link link-dark btn-toggle"> Home
                            </a>
                        </li> -->
                        <li>
                            <a href="rekap.php" class="nav-link link-dark btn-toggle"> Rekap
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="data:image/jpeg;base64,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" alt="" width="32" height="32" class="rounded-circle me-2">
                            <strong>Admin</strong>
                        </a>
                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php">Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <!-- End of Sidebar -->
        
        </body>

    </html>
