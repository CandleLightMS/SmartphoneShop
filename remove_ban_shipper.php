<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$email = $_GET['email'];
$head = $_GET['head'];

mysqli_query($conn, "DELETE FROM banned_shippers WHERE email = '$email'");

mysqli_close($conn);

if($head=='v')
    header("location: view_shippers.php");
else if($head=='u')
    header("location: update_shippers.php");