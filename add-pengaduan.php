<?php
require_once 'koneksi.php';

$gambar = $_FILES['gambar']['name'];
$subjek = $_POST['subjek'];
$isi = $_POST['isi'];
$IdMasyarakat = $_POST['IdMasyarakat'];
$balasan = "Belum";


if(isset($_POST['send'])) {
 
  $eks_dibolehkan = ['png', 'jpg', 'jpeg', 'bmp']; // ekstensi yang diperbolehkan
  $x = explode('.', $gambar); // memisahkan nama file dengan ekstensi
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['gambar']['tmp_name'];

  // cek ekstensi yang dibolehkan
  if (empty($_FILES['gambar']['name']) && empty($_FILES['gambar']['tmp_name'])){
        // jalankan query insert
      $query = "INSERT INTO tbl_pengaduan (subjek_pengaduan,isi_pengaduan,tgl_pengaduan,bukti_pengaduan,balasan_pengaduan,id_masyarakat) 
                VALUES ('$subjek','$isi',now(),NULL,'$balasan','$IdMasyarakat')";
      $hasil = mysqli_query($koneksi, $query);
      if($hasil) {
      header('Location:confirm-pengaduan.php?msg=berhasil');
      } 
      else {
      header('Location:create-pengaduan.php?pesan=gagal');
      } 
  }
  else{
   if(in_array($ekstensi, $eks_dibolehkan) === true) {
      move_uploaded_file($file_tmp, 'buktifoto/' . $gambar); // memindahkan file gambar
   
      // jalankan query insert
      $query = "INSERT INTO tbl_pengaduan (subjek_pengaduan,isi_pengaduan,tgl_pengaduan,bukti_pengaduan,balasan_pengaduan,id_masyarakat) 
                  VALUES ('$subjek','$isi',now(),'$gambar','$balasan','$IdMasyarakat')";
      $hasil = mysqli_query($koneksi, $query);

      if($hasil) {
         header('Location:confirm-pengaduan.php?msg=berhasil');
      } 
      else {
         header('Location:create-pengaduan.php?pesan=gagal');
      }
      } 
      else {
         header('Location:create-pengaduan.php?pesan=ekstensi');
      }
   }
} 
else {
   header('Location:create-pengaduan.php?pesan=lengkapi');
}