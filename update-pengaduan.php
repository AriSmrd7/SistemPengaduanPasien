<?php
require_once 'koneksi.php';

$gambar = $_FILES['gambar']['name'];
$subjek = $_POST['subjek'];
$isi = $_POST['isi'];
$IdMasyarakat = $_POST['IdMasyarakat'];
$IdPengaduan = $_POST['IdPengaduan'];
$tglubah = $_POST['tglubah'];


if(isset($_POST['send'])) {
 
  $eks_dibolehkan = ['png', 'jpg', 'jpeg', 'bmp']; // ekstensi yang diperbolehkan
  $x = explode('.', $gambar); // memisahkan nama file dengan ekstensi
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['gambar']['tmp_name'];

  // cek ekstensi yang dibolehkan
  if (empty($_FILES['gambar']['name']) && empty($_FILES['gambar']['tmp_name'])){
        // jalankan query insert
      $query = "UPDATE tbl_pengaduan SET subjek_pengaduan='$subjek', isi_pengaduan='$isi',tgl_pengaduan=now(), bukti_pengaduan=NULL, 
                id_masyarakat='$IdMasyarakat' WHERE id_pengaduan='$IdPengaduan'";
      $hasil = mysqli_query($koneksi, $query);
      if($hasil) {
      header('Location:daftar-pengaduan.php?pesan=sukses');
      } 
      else {
      header('Location:daftar-pengaduan.php?pesan=gagal');
      } 
  }
  else{
   if(in_array($ekstensi, $eks_dibolehkan) === true) {
      move_uploaded_file($file_tmp, 'buktifoto/' . $gambar); // memindahkan file gambar
   
      // jalankan query insert
      $query = "UPDATE tbl_pengaduan SET subjek_pengaduan='$subjek', isi_pengaduan='$isi',tgl_pengaduan=now(), bukti_pengaduan='$gambar', 
                id_masyarakat='$IdMasyarakat' WHERE id_pengaduan='$IdPengaduan'";
      $hasil = mysqli_query($koneksi, $query);

      if($hasil) {
         header('Location:daftar-pengaduan.php?pesan=sukses');
      } 
      else {
         header('Location:daftar-pengaduan.php?pesan=gagal');
      }
      } 
      else {
         header('Location:daftar-pengaduan.php?pesan=ekstensi');
      }
   }
} 
else {
   header('Location:daftar-pengaduan.php?pesan=lengkapi');
}