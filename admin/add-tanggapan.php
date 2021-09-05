<?php
require_once '../koneksi.php';

$isitanggapan = $_POST['isitanggapan'];
$IdPetugas    = $_POST['IdPetugas'];
$IdPengaduan  = $_POST['IdPengaduan'];
$status       = $_POST['status'];

if(isset($_POST['balas'])) {

  // cek form takut kosong
  if (!empty($isitanggapan) && !empty($IdPetugas) && !empty($IdPengaduan) && !empty($status))
  {
      $query = "INSERT INTO tbl_tanggapan (tgl_balas_tanggapan,status_tanggapan,isi_tanggapan,id_petugas,id_pengaduan) 
               VALUES (now(),'$status','$isitanggapan','$IdPetugas','$IdPengaduan')";
      $hasil = mysqli_query($koneksi, $query);
      if($hasil) {
         header('Location:pesan-pengaduan.php?pesan=sukses');
      } 
      else {
         header('Location:pesan-pengaduan.php?pesan=gagal');
      } 
  }
  else {
   header('Location:pesan-pengaduan.php?pesan=sama');
  }
} 
else {
   header('Location:pesan-pengaduan.php?pesan=lengkapi');
}