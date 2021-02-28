<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$user_id = $_SESSION['login_user'];

$add_query = mysqli_query($conn, "SELECT u_address FROM customer WHERE login_id = '$user_id'");
$add_array = mysqli_fetch_row($add_query);
$add = $add_array[0];

$pin_query = mysqli_query($conn, "SELECT u_pincode FROM customer WHERE login_id = '$user_id'");
$pin_array = mysqli_fetch_row($pin_query);
$pin = $pin_array[0];

$phn_query = mysqli_query($conn, "SELECT u_phone FROM customer WHERE login_id = '$user_id'");
$phn_array = mysqli_fetch_row($phn_query);
$phn = $phn_array[0];

if(isset($_POST['submitbtn']))
{
    if(!empty($_POST['address'] || $_POST['pincode'] || $_POST['phone']))
    {
        $address = $_POST['address'];
        $pincode = $_POST['pincode'];
        $phone = $_POST['phone'];
    
        mysqli_query($conn, "UPDATE customer SET u_address = '$address' WHERE login_id = '$user_id'");
        mysqli_query($conn, "UPDATE customer SET u_pincode = $pincode WHERE login_id = '$user_id'");
        mysqli_query($conn, "UPDATE customer SET u_phone = $phone WHERE login_id = '$user_id'");
    }
    header("location: update_customer.php");
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
            <form role="form" method="post" action="loginsession.php">
            <button type="submit" class="btn btn-primary">
            Home</button>
            </form>
        </div>
        </div>        
        
        <div class="col-md-1"></div>
        
        <div class="col-md-4" style="margin-top: 10%; margin-left: 5%; background-color: lightyellow; border: solid 5px lightgray">
            
            <form role="form" method="post" action="">
            
            <h2>Update Address/Pincode</h2>            
            
            <label for="address"> Address</label>
            <input type="text" class="form-control" name="address" value="<?php echo $add; ?>">                            
                    
            <br>           
            
            <label for="pincode"> Pincode</label>
            <input type="text" class="form-control" name="pincode" value="<?php echo $pin; ?>">            
            
            <br>
            
            <label for="phone"> Phone No.</label>
            <input type="text" class="form-control" name="phone" value="<?php echo $phn; ?>">            
            
            <br>
            
            <button type="submit" class="btn btn-group" name ="submitbtn" style="border-color: lightgray">Update</button>
            </form>
            
        </div>
        
    </div>        
    </div>

   </body>
   
</html>