<?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'koneksi.php';

// menangkap data yang dikirim dari form
$email = mysqli_real_escape_string($koneksi,$_POST['email']);
$password = md5(mysqli_real_escape_string($koneksi,$_POST['password']));
 
// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($koneksi,"select * from tbl_masyarakat where email='$email' and password='$password'");
 
// menghitung jumlah data yang ditemukan
$see = mysqli_fetch_assoc($data);
if($see['email'] != null){
	$_SESSION['email'] = $email;
	$_SESSION['nama'] = $see['nama'];
	$_SESSION['id_masyarakat'] = $see['id_masyarakat'];
	header("location:index.php");
}else{
 	header("location:login.php?pesan=gagal");
}
?>
