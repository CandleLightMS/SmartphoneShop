<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

    $status_array = mysqli_fetch_row(mysqli_query($conn, "SELECT status from verify where login_id= '$_SESSION[login_user]'"));
    $status = $status_array[0];
    
    if($status==0)
    {
        echo '<script language="javascript">'
        . 'alert("To continue shopping you must verify your e-mail id, activate your account & then log in again.")'
            . '</script>';
        
        header("refresh:0; url=loginsession.php");
    }
    else
    {
        $product = $_GET['sp_id'];
        $user_id = $_SESSION['login_user'];
    
        $quantity_array = mysqli_fetch_row(mysqli_query($conn, "SELECT quantity FROM smartphone where sp_id = $product"));
        $quantity = $quantity_array[0];
    
        if($quantity>0)
        {    
            $price_array = mysqli_fetch_row(mysqli_query($conn, "SELECT price FROM smartphone where sp_id = $product"));
            $price = $price_array[0];
    
            $gst = 12.0/100*$price;
    
            $item_total = $price + $gst;
    
            $cart_item_id = 1;
    
            $maxrowobj = mysqli_query($conn, "SELECT MAX(cart_item_id) as max FROM cart");            
            $maxrow = mysqli_fetch_array($maxrowobj);
            $cart_item_id = $maxrow['max'];
    
            $cart_item_id++;
        
            $seller_array = mysqli_fetch_row(mysqli_query($conn, "SELECT login_id FROM smartphone where sp_id = $product"));
            $seller_login_id = $seller_array[0];
    
            $sql = "INSERT INTO cart (cart_item_id, sp_id, customer_login_id, price, gst, item_total, seller_login_id) VALUES "
            . "($cart_item_id, $product, '$user_id', $price, $gst, $item_total, '$seller_login_id')";
    
    
            if(mysqli_query($conn, $sql)) 
            {        
                echo '<script language="javascript">';
                echo 'alert("Added to Cart.")';
                echo '</script>';
            
                $quantity = $quantity-1;
            
                mysqli_query($conn, "UPDATE smartphone SET quantity = $quantity WHERE sp_id = $product");
            }
            else
            {
                echo '<script language="javascript">';
                echo 'alert("Error! The product could not be added to cart.")';
                echo '</script>';        
            }
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("The product could not be added to cart because the item is OUT OF STOCK.")';
            echo '</script>';                
        }
    
        echo '<script language="javascript">
        history.go(-2);
        </script>';
    }

mysqli_close($conn);

?>

<html>   
   <head>
        <meta charset="UTF-8">
        <title>Smartphone Shop</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <link href = "home.css" rel = "stylesheet"/>
        
        <script>
            $(document).ready(function()
            {
                $("#loginmodal").modal();
            });
        </script>
    </head>
    
    <body>
    </body>
</html>