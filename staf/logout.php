<?php 
session_start();
session_destroy();

header("location:../staf_login.php?alert=logout");
?>