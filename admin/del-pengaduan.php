<?php
include "../koneksi.php";
  $id = $_GET['id'];
  $data = mysqli_query($koneksi,"DELETE from tbl_pengaduan where id_pengaduan='$id'");
  if ($data){
    header('Location:daftar-pengaduan.php?pesan=hapus');
  }
  ?>