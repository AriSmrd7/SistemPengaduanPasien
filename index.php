<?php 
	session_start();

    // cek apakah yang mengakses halaman ini sudah login
	if(empty($_SESSION['email'])){
		header("location:login.php");
	}
  $page = "Dashboard";

  include "koneksi.php";
	?>
  <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo.png" rel="icon">
  <title>Pengaduan - Dashboard</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <img src="img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3">Pengaduan</div>
      </a>

      <?php include "menu.php"; ?>

      <hr class="sidebar-divider">
    </ul>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small"><?php echo $_SESSION['nama']; ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>
           <div class='alert alert-light alert-dismissible' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
              Halo <b class="text-primary"><?php echo $_SESSION['nama'];?></b>,  Selamat Datang di Website Pengaduan.
            </div>           
          <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                    <?php 
                      $idm = $_SESSION['id_masyarakat'];
                      $pd = mysqli_query($koneksi,"SELECT COUNT(*) AS jumlah FROM tbl_pengaduan WHERE id_pengaduan IN
                      (SELECT id_pengaduan FROM tbl_tanggapan) AND id_masyarakat = '$idm'");
                      $r = mysqli_fetch_array($pd)
                     ?>
                      <div class="text-sm font-weight-bold text-uppercase mb-1">Pesan Belum Terbaca</div>
                      <div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $r['jumlah'];?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                     <?php 
                      $idm = $_SESSION['id_masyarakat'];
                      $pd = mysqli_query($koneksi,"SELECT COUNT(*) AS jumlah FROM tbl_pengaduan WHERE id_pengaduan NOT IN
                      (SELECT id_pengaduan FROM tbl_tanggapan) AND id_masyarakat = '$idm'");
                      $r = mysqli_fetch_array($pd)
                     ?>
                      <div class="text-sm font-weight-bold text-uppercase mb-1">Pesan Belum Dibalas</div>
                      <div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $r['jumlah'] ; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comment fa-2x text-danger"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
            <!-- Pending Requests Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <?php 
                      $idm = $_SESSION['id_masyarakat'];
                      $tp = mysqli_query($koneksi,"SELECT COUNT(*) AS jumlah FROM tbl_pengaduan  WHERE id_masyarakat='$idm'");
                      $row = mysqli_fetch_array($tp)
                    ?>
                      <div class="text-sm font-weight-bold text-uppercase mb-1">Total Pengaduan</div>
                      <div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $row['jumlah']; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-file fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->

          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Yakin akan logout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
                  <a href="logout.php" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - developed by
              <b><a href="">Ari Sumardi</a></b>
            </span>
          </div>
        </div>
      </footer>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>  
</body>

</html>