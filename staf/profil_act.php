<?php 
include '../koneksi.php';
session_start();

$id = $_SESSION['id'];

$username  = $_POST['username'];
$nama  = $_POST['nama'];

$rand = rand();

$allowed =  array('gif','png','jpg','jpeg','jfif');

$filename = $_FILES['foto']['name'];

if($filename == ""){

	mysqli_query($koneksi, "update staf set staf_nama='$nama', staf_username='$username' where staf_id='$id'")or die(mysqli_error($koneksi));
	header("location:profil.php?alert=sukses");

}else{

	$ext = pathinfo($filename, PATHINFO_EXTENSION);

	if(in_array($ext,$allowed) ) {

		// hapus file lama
		$lama = mysqli_query($koneksi,"select * from staf where staf_id='$id'");
		$l = mysqli_fetch_assoc($lama);
		$nama_file_lama = $l['staf_foto'];
		unlink("../gambar/user/".$nama_file_lama);

		// upload file baru
		move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/user/'.$rand.'_'.$filename);
		$nama_file = $rand.'_'.$filename;
		mysqli_query($koneksi, "update staf set staf_nama='$nama', staf_username='$username', staf_foto='$nama_file' where staf_id='$id'")or die(mysqli_error($koneksi));
		header("location:profil.php?alert=sukses");

	}else{

		header("location:profil.php?alert=gagal");
	}

}
