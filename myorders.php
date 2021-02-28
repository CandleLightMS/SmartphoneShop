<?php 

session_start();

include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$orders_query=mysqli_query($conn, "SELECT order_id FROM orders where customer_login_id='$_SESSION[login_user]'");

echo ''
.   '<div class="container-fluid">
    <div class="row" style="padding-left: 5%; padding-top: 4%">
    <div class="btn-group">
        <a href="loginsession.php">
        <button type="button" class="btn btn-primary">Home</button>
        </a>
    </div>
    </div>
    </div>';

while($order_id_array = mysqli_fetch_row($orders_query))
{
    
$order_id = $order_id_array[0];

$total_price_array = mysqli_fetch_row(mysqli_query($conn, "SELECT total_price FROM orders where order_id=$order_id"));
$total_price = $total_price_array[0];

$discount_array = mysqli_fetch_row(mysqli_query($conn, "SELECT discount FROM orders where order_id=$order_id"));
$discount = $discount_array[0];

$order_total_array = mysqli_fetch_row(mysqli_query($conn, "SELECT order_total FROM orders where order_id=$order_id"));
$order_total = $order_total_array[0];

$transaction_id_array = mysqli_fetch_row(mysqli_query($conn, "SELECT transaction_id FROM orders where order_id=$order_id"));
$transaction_id = $transaction_id_array[0];

$isPacked_array = mysqli_fetch_row(mysqli_query($conn, "SELECT isPacked FROM orders where order_id=$order_id"));
$isPacked = $isPacked_array[0];

$isShipped_array = mysqli_fetch_row(mysqli_query($conn, "SELECT isShipped FROM orders where order_id=$order_id"));
$isShipped = $isShipped_array[0];

$isDelivered_array = mysqli_fetch_row(mysqli_query($conn, "SELECT isDelivered FROM orders where order_id=$order_id"));
$isDelivered = $isDelivered_array[0];

$sp_id_array = mysqli_fetch_row(mysqli_query($conn, "SELECT sp_id FROM orders where order_id=$order_id"));
$sp_id = $sp_id_array[0];

$review_array = mysqli_fetch_row(mysqli_query($conn, "SELECT hasBeenReviewed FROM orders where order_id=$order_id"));
$hasBeenReviewd = $review_array[0];

$product_query = mysqli_query($conn, "SELECT * FROM smartphone where sp_id=$sp_id");

$counter = 0;

while ($row = mysqli_fetch_row($product_query))
{
    $count=0;
    
    echo '<div class="container-fluid">';
    echo '<div class="row">';    
    echo '<div class="col-md-4" style="margin-top: 5%; padding-left: 5%; padding-right: 5%">';
    
    $counter++;
    
    print nl2br("<center><img src=$row[6] height='350px' width='300px' /></center>\n");    
    
    print nl2br("<h4>Specifications:</h4>");
    
    foreach ($row as $value)
    {
        $count++;
        
        if($count==1 || $count==2 || $count==5 || $count==7 || $count==10)
            continue;
        
        else
        {
            print ("<b>");
            
            switch ($count)
            {           
                case 3:
                print ("Model: ");
                break;
            
                case 4:
                print ("Brand: ");
                break;
            
                case 6:
                print ("Box Contents: ");
                break;
            
                case 8:
                print ("Colour: ");
                break;
            
                case 9:
                print ("Description: ");
                break;
            }
        
            if($count!=9)
                print nl2br("</b>" . $value . "\n");
            else
            {
                print nl2br("</b>");
                
                $str = $value;                
                $limit = 250;
                
                if(strlen($str)>$limit)
                {
                    $stringCut = substr($str, 0, $limit);
                    $serRpos = strrpos($stringCut, ' ');
                    $first_part = substr(substr($str, 0, $limit), 0,$serRpos);
                    $last_part = substr($str,$serRpos);
                    echo $first_part;
                    echo '<span style="cursor: pointer" onclick="showText(this)"> '
                    . '...<span class="hide-text" style="display: none;">'.$last_part.'</span></span>';
                }
                else
                {
                    echo $str;
                }
            }
        }        
                
        echo ''
        . '<script type="text/javascript">
        function showText(e)
        {
            $(e).html($(e).find(".hide-text").html());
        }
        </script>';        
        
        if($count==9)
        {
            print nl2br("\n\n<b>Price:</b> Rs. ". $row[4]);
            print nl2br("\n<b>GST:</b> Rs. ". (12.0/100* $row[4]));            
            print nl2br("\n<b>Total Price:</b> Rs. ". $total_price);            
            print nl2br("\n<b>Discount:</b> Rs. ". $discount);
            print nl2br("\n\n<b>Order Total:</b> Rs. ". $order_total);
            print nl2br("\n\n<b>Transaction Id:</b> ". $transaction_id);
        }
        
        if($count==9 && !$isPacked)
        {
            print nl2br("\n\n");
                                    
            echo ''    
            . '<center><div style="font-size: 16px; padding-top: 7px; padding-bottom: 7px; '
                    . 'background-color: black; color: white">'
                .' Order received. Seller\'s response awaited.' 
            . '</div></center>';
        }    
        else if($count==9 && $isPacked && !$isShipped)
        {
            print nl2br("\n\n");
                        
            echo ''    
            . '<center><div style="font-size: 16px; padding-top: 7px; padding-bottom: 7px; '
                    . 'background-color: black; color: white">'
                .' Packed Product - Ready to Dispatch'
            . '</div></center>';
        }
        else if($count==9 && $isShipped && !$isDelivered)
        {
            print nl2br("\n\n");
                        
            echo ''    
            . '<center><div style="font-size: 16px; padding-top: 7px; padding-bottom: 7px; '
                    . 'background-color: black; color: white">'
                .' Product Dispatched'
            . '</div></center>';
        }
        else if($count==9 && $isDelivered)
        {
            print nl2br("\n\n");
                        
            echo ''    
            . '<center><div style="font-size: 16px; padding-top: 7px; padding-bottom: 7px; '
                    . 'background-color: black; color: white">'
                .' Product Delivered'
            . '</div></center>';
            
            if(!$hasBeenReviewd)
            {
                echo ''    
                . '<form class="form-inline" method="post" action="reviewproduct.php?order_id='.$order_id.'">'                
                . '<center><button type="submit" class="btn btn-block"
                style="font-size: 16px; border-color: gray; color: black; background-color: white; margin-top: 4px">'
                .' Review Product'
                . '</button></center>               '
                . '</form>';
            }
            else
            {
                echo ''    
                . '<center><button type="submit" class="btn btn-block" disabled
                style="font-size: 16px; border-color: gray; color: black; background-color: white; margin-top: 4px">'
                .' Product Review Submitted'
                . '</button></center>';                                
            }            
        }
    }
    
    echo '</div>';
    if($counter%3==0)
    {
        echo '</div>';
        echo '</div>';
    }
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
                background-color: lightgray;
                color: black;
            }
        </style>
   </head>
   
   <body>
   </body>
   
</html>