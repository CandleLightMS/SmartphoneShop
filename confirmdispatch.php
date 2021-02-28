<?php

session_start();

include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$order_id = $_GET['order_id'];

$isPacked_array = mysqli_fetch_row(mysqli_query($conn, "SELECT isPacked FROM orders WHERE order_id = $order_id"));
$isPacked = $isPacked_array[0];

$s_code_array = mysqli_fetch_row(mysqli_query($conn, "SELECT s_code FROM orders WHERE order_id = $order_id"));
$s_code = $s_code_array[0];

if(isset($_POST['submitbtn']))
{
    if(!empty($_POST['code']))
    {
        if($isPacked && ($_POST['code'] == $s_code))
        {
            mysqli_query($conn, "UPDATE orders SET isShipped = 1 WHERE order_id = '$order_id'");
            
            echo '<script language = "javascript">'
            . 'alert("Dispatch confirmed.");'
            . '</script>';
            
            header("refresh: 0; url=index.php");
        }
        else
        {
            echo '<script language = "javascript">'
            . 'alert("Dispatch could not be confirmed. Try again.");'
            . '</script>';
            
            header("refresh: 0; url=confirmdispatch.php?order_id=$order_id");
        }
    }
}

mysqli_close($conn);

?>

<html>
   
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href = "home.css" rel = "stylesheet"/>        
    </head>
   
    <body>       
    
    <div class="container-fluid">    
    <div class="row">                
        
        <div class="col-md-2" style="margin-top: 5%; margin-left: 5%">
        <div class="container-fluid">
            <form role="form" method="post" action="index.php">
            <button type="submit" class="btn btn-primary">
            Home</button>
            </form>
        </div>
        </div>        
        
        <div class="col-md-1"></div>
        
        <div class="col-md-4" style="margin-top: 10%; margin-left: 5%; background-color: lightyellow; border: solid 5px lightgray">
            
            <form role="form" method="post" action="">
            
            <h2>Enter dispatch confirmation code:</h2>            
                        
            <input type="text" class="form-control" name="code">            
            
            <br>
            
            <button type="submit" class="btn btn-group" name ="submitbtn" style="border-color: lightgray">Submit</button>
            </form>
            
        </div>
        
    </div>        
    </div>

   </body>
   
</html>