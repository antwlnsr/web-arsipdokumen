<?php 
// menghubungkan dengan koneksi
include 'koneksi.php';

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = md5($_POST['password']);

$login = mysqli_query($koneksi, "SELECT * FROM staf WHERE staf_username='$username' AND staf_password='$password'");
$cek = mysqli_num_rows($login);

if($cek > 0){
	session_start();
	$data = mysqli_fetch_assoc($login);
	$_SESSION['id'] = $data['staf_id'];
	$_SESSION['nama'] = $data['staf_nama'];
	$_SESSION['username'] = $data['staf_username'];
	$_SESSION['status'] = "user_login";

	header("location:staf/");
}else{
	header("location:staf_login.php?alert=gagal");
}

