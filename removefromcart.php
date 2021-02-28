<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$cart_item_id = $_GET['cart_item_id'];
    
$product_array = mysqli_fetch_row(mysqli_query($conn, "SELECT sp_id FROM cart where cart_item_id = $cart_item_id"));
$product = $product_array[0];
    
$quantity_array = mysqli_fetch_row(mysqli_query($conn, "SELECT quantity FROM smartphone where sp_id = $product"));
$quantity = $quantity_array[0];
    
mysqli_query($conn, "DELETE FROM cart WHERE cart_item_id = $cart_item_id");
    
$quantity = $quantity + 1;
    
mysqli_query($conn, "UPDATE smartphone SET quantity = $quantity WHERE sp_id = $product");

mysqli_close($conn);

header("location: mycart.php");