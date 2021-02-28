<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$email = $_GET['email'];

$sql=mysqli_query($conn, "INSERT INTO banned_shippers (email) VALUES ('$email')");

header("location: view_shippers.php");

$conn->close();