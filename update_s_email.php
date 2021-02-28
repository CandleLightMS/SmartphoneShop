<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$user_id = $_SESSION['login_user'];

$email_query = mysqli_query($conn, "SELECT s_email FROM seller WHERE login_id = '$user_id'");
$email_array = mysqli_fetch_row($email_query);
$email = $email_array[0];

if(isset($_POST['submitbtn']))
{
    $e = $_POST['email'];
    
    $flag = 0;
    
    if(empty($_POST['email']))
    {
        $flag = 1;
    }
    
    $slquery = "SELECT * FROM seller WHERE s_email = '$e'";
    $selectresult = mysqli_query($conn, $slquery);
    if(mysqli_num_rows($selectresult)>0 && $e!=$email)
    {
        echo '<script language="javascript">';
        echo 'alert("This e-mail id already exists.")';
        echo '</script>';
            
        $flag = 1;
    }    
    
    if($flag==0)
    {
        mysqli_query($conn, "UPDATE seller SET s_email = '$e' WHERE login_id = '$user_id'");
        mysqli_query($conn, "UPDATE verify SET status = 0, code = 0 WHERE login_id = '$user_id'");
        header("location: update_seller.php");
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
            <form role="form" method="post" action="sellerloginsession.php">
            <button type="submit" class="btn btn-primary">
            Home</button>
            </form>
        </div>
        </div>        
        
        <div class="col-md-1"></div>
        
        <div class="col-md-4" style="margin-top: 10%; margin-left: 5%; background-color: lightyellow; border: solid 5px lightgray">
            
            <form role="form" method="post" action="">
            
            <h2>Update E-mail Id</h2>            
            
            <label for="email"> E-mail Id</label>
            <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">            
            
            <br>
            
            <button type="submit" class="btn btn-group" name ="submitbtn" style="border-color: lightgray">Update</button>
            </form>
            
        </div>
        
    </div>        
    </div>

   </body>
   
</html>