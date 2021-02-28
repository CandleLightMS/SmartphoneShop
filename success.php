<?php

session_start();

include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="gHg63FRep4";

// Salt should be same Post Request 

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
  } else {
        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
         }
		 $hash = hash("sha512", $retHashSeq);
       if ($hash != $posted_hash) {
	       echo "Invalid Transaction. Please try again";
		   } else {
                       
                       $paid_amount = $_POST["amount"];
          $cart_item_id = $_GET['cart_item_id'];
          
          $item_total_array = mysqli_fetch_row(mysqli_query($conn, "SELECT item_total FROM cart WHERE cart_item_id = $cart_item_id"));
          $item_total = $item_total_array[0];
          
          if($paid_amount == $item_total || ($paid_amount-$item_total>0 && $paid_amount-$item_total<=10.0))
          {
                echo "<h3>Thank You. Payment status: ". $status .".</h3>";
                echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
                echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";
                echo "<br>"
                . "<h2>DO NOT REFRESH THIS PAGE. YOU WILL SOON BE REDIRECTED.</h2>";
          
                header("refresh: 0; url=add_order.php?cart_item_id=$cart_item_id&&transaction_id=$txnid");
          }          
          else
          {
                echo "<h3>Payment status: ". $status .".</h3>";
                echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
                echo "<h4>We have received a payment of Rs. " . $amount . ". Received payment is not equal to the total price"
                        . " & hence the order is not placed. The paid amount will soon be refunded to you.</h4>";
                
                $cust_login_array = mysqli_fetch_row(mysqli_query($conn, "SELECT customer_login_id FROM cart WHERE cart_item_id = $cart_item_id"));
                $customer_login_id = $cust_login_array[0];
                
                header("refresh: 0; url=refund.php?amount=$paid_amount&&customer_login_id=$customer_login_id");
          }
		   }
                   
?>

<html>
   
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            body
            {
                background-color: lightyellow;
                margin-left: 5%;
            }
        </style>
   </head>
   
   <body>
       <div class="container-fluid">    
            <div class="row">
                
                <div class="col-md-10"></div>                
                <div class="col-md-2">
                    <form action='loginsession.php'>
                    <div class="btn-group" style="padding-top: 10%">
                        <button type="submit" class="btn btn-primary btn-block" 
                                style="background-color: lightgray; color: black">Back to Home</button>
                    </div>
                </form>
                </div>
                
            </div>
        </div>
   </body>
   
</html>