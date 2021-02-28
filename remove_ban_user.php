<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$login_id = $_GET['login_id'];

$user_type_array = mysqli_fetch_row(mysqli_query($conn, "SELECT user_type FROM banned_users WHERE login_id = '$login_id'"));
$user_type = $user_type_array[0];

mysqli_query($conn, "DELETE FROM banned_users WHERE login_id = '$login_id'");

mysqli_close($conn);

if($user_type == 'C')
    header("location: view_customers.php");

if($user_type == 'S')
    header("location: view_sellers.php");