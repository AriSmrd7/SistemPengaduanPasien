<?php
include "../koneksi.php";
  $id = $_GET['id'];
  $data = mysqli_query($koneksi,"DELETE from tbl_masyarakat where id_masyarakat='$id'");
  if ($data){
    header('Location:daftar-masyarakat.php?pesan=hapus');
  }
  ?>