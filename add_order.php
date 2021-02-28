<?php 

session_start();

include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

include 'C:\wamp64\www\PHPMailer.php';
include 'C:\wamp64\www\SMTP.php';
include 'C:\wamp64\www\Exception.php';
include 'C:\wamp64\www\OAuth.php';
include 'C:\wamp64\www\POP3.php';

$customer_login_id = $_SESSION['login_user'];
$cart_item_id = $_GET['cart_item_id'];
$transaction_id = $_GET['transaction_id'];

$order_id = 1;
    
$maxrowobj = mysqli_query($conn, "SELECT MAX(order_id) as max FROM orders");            
$maxrow = mysqli_fetch_array($maxrowobj);
$order_id = $maxrow['max'];
    
$order_id++;

$item_query = mysqli_query($conn, "SELECT * FROM cart WHERE cart_item_id = $cart_item_id");

$sp_id_array = mysqli_fetch_row(mysqli_query($conn, "SELECT sp_id FROM cart WHERE cart_item_id = $cart_item_id"));
$sp_id = $sp_id_array[0];

$total_price_array = mysqli_fetch_row(mysqli_query($conn, "SELECT item_total FROM cart WHERE cart_item_id = $cart_item_id"));
$total_price = $total_price_array[0];

$cust_login_array = mysqli_fetch_row(mysqli_query($conn, "SELECT customer_login_id FROM cart WHERE cart_item_id = $cart_item_id"));
$customer_login_id = $cust_login_array[0];

$seller_login_array = mysqli_fetch_row(mysqli_query($conn, "SELECT seller_login_id FROM cart WHERE cart_item_id = $cart_item_id"));
$seller_login_id = $seller_login_array[0];
        
$order_timestamp = date("Y-m-d H:i:s");

$discount = 0;

$order_total = $total_price - $discount;

$s_address_array = mysqli_fetch_row(mysqli_query($conn, "SELECT s_address FROM seller WHERE login_id = '$seller_login_id'"));
$s_address = $s_address_array[0];

$c_address_array = mysqli_fetch_row(mysqli_query($conn, "SELECT u_address FROM customer WHERE login_id = '$customer_login_id'"));
$c_address = $c_address_array[0];

$seller_sh_id_query = mysqli_query($conn, "SELECT * FROM shipper WHERE sh_address LIKE '%".$s_address."%'");

do
{
    if(mysqli_num_rows($seller_sh_id_query)>0)
    {
        $seller_sh_id_array = mysqli_fetch_row($seller_sh_id_query);
        $seller_sh_id = $seller_sh_id_array[0];
    }
    else
    {
        $maxrowobj = mysqli_query($conn, "SELECT MAX(sh_id) as max FROM shipper");            
        $maxrow = mysqli_fetch_array($maxrowobj);            
        $max = $maxrow['max'];
    
        $seller_sh_id = rand(1, $max);
    }
    $ssh_email_array = mysqli_fetch_row(mysqli_query($conn, "SELECT sh_email FROM shipper WHERE sh_id = $seller_sh_id"));
    $ssh_email = $ssh_email_array[0];
    
    $isShipperBanned = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM banned_shippers WHERE email = '$ssh_email'"));

}while($isShipperBanned>0);

$customer_sh_id_query = mysqli_query($conn, "SELECT * FROM shipper WHERE sh_address LIKE '%".$c_address."%'");

do
{
    if(mysqli_num_rows($customer_sh_id_query)>0)
    {
        $customer_sh_id_array = mysqli_fetch_row($customer_sh_id_query);
        $customer_sh_id = $customer_sh_id_array[0];
    }
    else
    {
        $maxrowobj = mysqli_query($conn, "SELECT MAX(sh_id) as max FROM shipper");            
        $maxrow = mysqli_fetch_array($maxrowobj);            
        $max = $maxrow['max'];
    
        $customer_sh_id = rand(1, $max);
    }
    
    $csh_email_array = mysqli_fetch_row(mysqli_query($conn, "SELECT sh_email FROM shipper WHERE sh_id = $customer_sh_id"));
    $csh_email = $csh_email_array[0];
    
    $isShipperBanned = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM banned_shippers WHERE email = '$csh_email'"));

}while($isShipperBanned>0);

$s_code = rand(100000, 999999);
        
$c_code = rand(100000, 999999);

$c_email_array = mysqli_fetch_row(mysqli_query($conn, "SELECT u_email FROM customer WHERE login_id = '$customer_login_id'"));
$c_email = $c_email_array[0];

$s_email_array = mysqli_fetch_row(mysqli_query($conn, "SELECT s_email FROM seller WHERE login_id = '$seller_login_id'"));
$s_email = $s_email_array[0];

$c_sh_email_array = mysqli_fetch_row(mysqli_query($conn, "SELECT sh_email FROM shipper WHERE sh_id = $customer_sh_id"));
$c_sh_email = $c_sh_email_array[0];

$s_sh_email_array = mysqli_fetch_row(mysqli_query($conn, "SELECT sh_email FROM shipper WHERE sh_id = $seller_sh_id"));
$s_sh_email = $s_sh_email_array[0];

$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->IsSMTP();

$mail->SMTPDebug = 1;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->IsHTML(true);
$mail->Username = "msprojects7@gmail.com";
$mail->Password = "clmsem77";
$mail->SetFrom("msprojects7@gmail.com");

$mail->Subject = "Smartphone Shop: Delivery Confirmation Code";
$mail->Body = 'Your delivery confirmation code is '.$c_code.'.';
$mail->AddAddress("$c_email");
$mail->send();
$mail->ClearAddresses();

$mail->Subject = "Smartphone Shop: Product Dispatch Confirmation Code";
$mail->Body = 'Your confirmation code for the dispatch of product is '.$s_code.'.';
$mail->AddAddress("$s_email");
$mail->send();
$mail->ClearAddresses();

$mail->Subject = "Smartphone Shop: Delivery Confirmation Link";
$mail->Body = '<a href = "http://localhost/SmartphoneShop/confirmdelivery.php?order_id='.$order_id.'">Click here'
        . '</a> to confirm product delivery & enter the code sent to the customer\'s e-mail id.';
$mail->AddAddress("$c_sh_email");
$mail->send();
$mail->ClearAddresses();

$mail->Subject = "Smartphone Shop: Product Dispatch Confirmation Link";
$mail->Body = '<a href = "http://localhost/SmartphoneShop/confirmdispatch.php?order_id='.$order_id.'">Click here'
        . '</a> to confirm dispatch of product & enter the code sent to the seller\'s e-mail id.';
$mail->AddAddress("$s_sh_email");
$mail->send();

mysqli_query($conn, "INSERT INTO orders (order_id, sp_id, total_price, discount, order_total, order_timestamp, 
seller_login_id, customer_login_id, transaction_id, seller_sh_id, customer_sh_id, s_code, c_code) 
VALUES ($order_id, $sp_id, $total_price, $discount, $order_total, '$order_timestamp', '$seller_login_id', "
        . "'$customer_login_id', '$transaction_id', $seller_sh_id, $customer_sh_id, $s_code, $c_code)");

echo '<script language="javascript">
    document.location.href="removefromcart.php?cart_item_id='.$cart_item_id.'";
    </script>';