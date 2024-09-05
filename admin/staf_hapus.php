<?php 
include '../koneksi.php';
$id = $_GET['id'];

$data = mysqli_query($koneksi, "select * from staf where staf_id='$id'");
$d = mysqli_fetch_assoc($data);
$foto = $d['staf_foto'];
unlink("../gambar/user/$foto");
mysqli_query($koneksi, "delete from staf where staf_id='$id'");
header("location:staf.php");
