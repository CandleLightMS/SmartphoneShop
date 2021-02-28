<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$user_id = $_SESSION['login_user'];
$product = $_GET['sp_id'];

mysqli_query($conn, "DELETE FROM best_offers WHERE sp_id = $product");

mysqli_close($conn);

header("location: update_best_offers.php");