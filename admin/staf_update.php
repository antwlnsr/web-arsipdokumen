<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$nama  = $_POST['nama'];
$username = $_POST['username'];
$pwd = $_POST['password'];
$password = md5($_POST['password']);

// cek gambar
$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');
$filename = $_FILES['foto']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

if($pwd=="" && $filename==""){
	mysqli_query($koneksi, "update staf set staf_nama='$nama', staf_username='$username' where staf_id='$id'");
	header("location:staf.php");
}elseif($pwd==""){
	if(!in_array($ext,$allowed) ) {
		header("location:staf.php?alert=gagal");
	}else{
		move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/user/'.$rand.'_'.$filename);
		$x = $rand.'_'.$filename;
		mysqli_query($koneksi, "update staf set staf_nama='$nama', staf_username='$username', staf_foto='$x' where staf_id='$id'");		
		header("location:staf.php?alert=berhasil");
	}
}elseif($filename==""){
	mysqli_query($koneksi, "update staf set staf_nama='$nama', staf_username='$username', staf_password='$password' where staf_id='$id'");
	header("location:staf.php");
}
