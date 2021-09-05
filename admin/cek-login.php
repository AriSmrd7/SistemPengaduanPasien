<?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include '../koneksi.php';

// menangkap data yang dikirim dari form login
$email = mysqli_real_escape_string($koneksi,$_POST['email']);
$password = md5(mysqli_real_escape_string($koneksi,$_POST['password']));


// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi,"select * from tbl_petugas where email='$email' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if($cek > 0){

	$data = mysqli_fetch_assoc($login);

	// cek jika petugas login sebagai admin
	if($data['level']=="Admin"){
		// buat session login dan email
		$_SESSION['email'] = $email;
		$_SESSION['nama'] = $data['nama'];
		$_SESSION['idp'] = $data['id_petugas'];
		$_SESSION['level'] = "Admin";
		// alihkan ke halaman dashboard admin
		header("location:index-admin.php");

	// cek jika user login sebagai petugas
	}else if($data['level']=="Petugas"){
		// buat session login dan username
		$_SESSION['email'] = $email;	
		$_SESSION['nama'] = $data['nama'];
		$_SESSION['idp'] = $data['id_petugas'];
		$_SESSION['level'] = "Petugas";
		// alihkan ke halaman dashboard petugas
		header("location:index-petugas.php");

	}else{

		// alihkan ke halaman login kembali
		header("location:login.php?pesan=gagal");
	}

}else{
	header("location:login.php?pesan=nothing");
}



?>