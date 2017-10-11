<?php 
include_once('auth/login.php');
$login = new Login();
$login->doLogout();
header("location: login.php");
?>