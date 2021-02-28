<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$email = $_GET['email'];

$add_query = mysqli_query($conn, "SELECT sh_address FROM shipper WHERE sh_email = '$email'");
$add_array = mysqli_fetch_row($add_query);
$add = $add_array[0];

$phn_query = mysqli_query($conn, "SELECT sh_phone FROM shipper WHERE sh_email = '$email'");
$phn_array = mysqli_fetch_row($phn_query);
$phn = $phn_array[0];

$nam_query = mysqli_query($conn, "SELECT sh_name FROM shipper WHERE sh_email = '$email'");
$nam_array = mysqli_fetch_row($nam_query);
$nam = $nam_array[0];

if(isset($_POST['submitbtn']))
{
    if(!empty($_POST['address'] || $_POST['phone'] || $_POST['name']))
    {
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $name = $_POST['name'];
    
        mysqli_query($conn, "UPDATE shipper SET sh_address = '$address' WHERE sh_email = '$email'");
        mysqli_query($conn, "UPDATE shipper SET sh_phone = '$phone' WHERE sh_email = '$email'");
        mysqli_query($conn, "UPDATE shipper SET sh_name = '$name' WHERE sh_email = '$email'");
    }
    header("location: update_shippers.php");
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
            <form role="form" method="post" action="shippersloginsession.php">
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
            
            <label for="phone"> Phone No.</label>
            <input type="text" class="form-control" name="phone" value="<?php echo $phn; ?>">            
            
            <br>
            
            <label for="name"> Name</label>
            <input type="text" class="form-control" name="name" value="<?php echo $nam; ?>">            
            
            <br>
            
            <button type="submit" class="btn btn-group" name ="submitbtn" style="border-color: lightgray">Update</button>
            </form>
            
        </div>
        
    </div>        
    </div>

   </body>
   
</html>