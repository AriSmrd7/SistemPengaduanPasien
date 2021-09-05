<?php
include "../koneksi.php";
  $id = $_GET['id'];
  $data = mysqli_query($koneksi,"DELETE from tbl_petugas where id_petugas='$id'");
  if ($data){
    header('Location:daftar-petugas.php?pesan=hapus');
  }
  ?>