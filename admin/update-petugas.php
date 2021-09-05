<?php
require_once '../koneksi.php';

$nama = $_POST['nama'];
$telepon = $_POST['telepon'];
$email = $_POST['email'];
$IdPetugas = $_POST['IdPetugas'];


if(isset($_POST['ubah'])) {

  // cek pw
  if ($pass1 == $pass2){
      $query = "UPDATE tbl_petugas SET nama='$nama', email='$email', telepon='$telepon' WHERE id_petugas='$IdPetugas'";
      $hasil = mysqli_query($koneksi, $query);
      if($hasil) {
         header('Location:daftar-petugas.php?pesan=sukses');
      } 
      else {
         header('Location:daftar-petugas.php?pesan=gagal');
      } 
  }
  else {
   header('Location:daftar-petugas.php?pesan=sama');
  }
} 
else {
   header('Location:daftar-petugas.php?pesan=lengkapi');
}