<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$phone_array = mysqli_fetch_row(mysqli_query($conn, "SELECT u_phone from customer where login_id= '$_GET[login_id]'"));
$phone = $phone_array[0];