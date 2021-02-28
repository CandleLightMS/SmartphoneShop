<?php 

session_start();

include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$order_id = $_GET['order_id'];

mysqli_query($conn, "UPDATE orders SET isPacked = TRUE WHERE order_id = $order_id");

header("location: ordersreceived.php");