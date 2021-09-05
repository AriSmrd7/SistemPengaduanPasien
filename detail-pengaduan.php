<?php 
	session_start();

    // cek apakah yang mengakses halaman ini sudah login
	if(empty($_SESSION['email'])){
		header("location:login.php?pesan=no");
	}
  $page = "List";
  include 'koneksi.php';

  $id = $_GET['id'];
  $data = mysqli_query($koneksi,"select * from tbl_pengaduan where id_pengaduan='$id'");
  $row = mysqli_fetch_array($data)
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
  <title>Pengaduan - Detail Pengaduan</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">

  <!-- Data Table -->
  <link href="vendor/datatables/dataTables.bootstrap4.css"  rel="stylesheet" type="text/css">
  <!-- END Data Table -->
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
          <div class="d-sm-flex align-items-center justify-content-between mb-0">
            <h1 class="h3 mb-0 text-gray-800">Tanggapan Pengaduan <?php echo $row['subjek_pengaduan'];?></h1>
          </div>

          <div class="row">
         ` <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-body">
                  <form action="add-pengaduan.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                     <h5 class="text-secondary"><b>Pengaduan</b></h5>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-3">
                        <label for="tgl" class="text-primary">Tanggal Pengaduan</label>
                      </div>
                      <div class="col-lg-7">
                       <label class="text-default"><?php echo tgl_indo($row['tgl_pengaduan']);?> </label>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-3">
                       <label for="subjek" class="text-primary">Subjek Keluhan</label>
                      </div>
                      <div class="col-lg-7">
                       <label class="text-default"><?php echo $row['subjek_pengaduan'];?> </label>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-3">
                       <label for="subjek" class="text-primary">Isi Keluhan</label>
                      </div>
                      <div class="col-lg-7">
                      <textarea class="form-control" readonly><?php echo $row['isi_pengaduan'];?> </textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-3">
                       <label for="subjek" class="text-primary">Bukti Dokumen</label>
                      </div>
                      <div class="col-lg-7">
                       <button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#exampleModal"
                    id="#myBtn"><?php echo $row['bukti_pengaduan'];?></button>
                        <!-- Modal Bukti -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                          aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Bukti Pengaduan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <p class="text-center">
                                  <img src="buktifoto/<?php echo $row['bukti_pengaduan'];?>" width="400dp" height="240dp">
                                </p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <br>
                    <center>
                    <a class='btn btn-sm btn-info' href='cetak-pengaduan.php?id=<?php echo $row['id_pengaduan'];?>'> Cetak Bukti Pengaduan</a>
                    <a class='btn btn-sm btn-primary' href='ubah-pengaduan.php?id=<?php echo $row['id_pengaduan'];?>'> Ubah </a>
                    <a class='btn btn-sm btn-danger' href='hapus-pengaduan.php?id=<?php echo $row['id_pengaduan'];?>'> Hapus</a> &nbsp;
                    </center>
                    <hr>


                  <!-- balasan -->
                  <?php 
                    $d = mysqli_query($koneksi,"select * from tbl_tanggapan JOIN tbl_petugas USING (id_petugas) where id_pengaduan='$id'");
                    $r = mysqli_fetch_array($d);
                    $cek = mysqli_num_rows($d);
                    
                    if ($cek == 0){
                      echo "<div class='alert alert-danger' role='alert'>
                      <i class='fa fa-2x fa-frown'></i><br>
                      <b> Maaf belum ada balasan.</b>
                      </div>"; 
                    }
                    else {
                  ?>
                  <div class="form-group">
                     <h5 class="text-secondary"><b>Balasan</b></h5>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-3">
                        <label for="tgl" class="text-primary">Petugas</label>
                      </div>
                      <div class="col-lg-7">
                       <label class="text-default"><?php echo $r['nama'];?> </label>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-3">
                        <label for="tgl" class="text-primary">Tanggal Balasan</label>
                      </div>
                      <div class="col-lg-7">
                       <label class="text-default"><?php echo $r['tgl_balas_tanggapan'];?> </label>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-3">
                       <label for="subjek" class="text-primary">Status</label>
                      </div>
                      <div class="col-lg-7">
                       <label class="text-default"><?php echo $r['status_tanggapan'];?> </label>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-3">
                       <label for="subjek" class="text-primary">Isi Balasan</label>
                      </div>
                      <div class="col-lg-7">
                      <textarea class="form-control" readonly><?php echo $r['isi_tanggapan'];?> </textarea>
                      </div>
                    </div>
                    </div>
                    <br>
                    <center>
                    <a href="cetak-tanggapan.php?id=<?php echo $r['id_tanggapan'];?>" class="btn btn-sm btn-info" >Cetak Tanggapan Pengaduan</a>
                    <button type="button" class="btn btn-sm btn-danger">Kembali</button> &nbsp;
                    </center>
                    <br>
                  <?php } ?>
                  <!-- end balasan -->
                  </form>
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
  <!-- Data Table -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script>
     $(document).ready(function(){
     $('#tabel-pengaduan').DataTable();
     })
  </script>
  <!-- END Data Table -->

</body>

</html>