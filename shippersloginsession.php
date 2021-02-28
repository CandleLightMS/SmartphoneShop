<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

include 'C:\wamp64\www\PHPMailer.php';
include 'C:\wamp64\www\SMTP.php';
include 'C:\wamp64\www\Exception.php';
include 'C:\wamp64\www\OAuth.php';
include 'C:\wamp64\www\POP3.php';

$login_id = $_SESSION['login_user'];

$user_type = mysqli_fetch_row(mysqli_query($conn, "SELECT user_type from login where login_id= '$_SESSION[login_user]'"));
        
if($user_type[0]=='D')
{
    $name = 'Shipping Company';
}
?>
<html>
   
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <?php
        
        if($name!=NULL)
            echo "<title>You are logged in as " . $name . ". </title>";
        ?>
        <link href = "home.css" rel = "stylesheet"/>        
   </head>
   
   <body>
       
       <div class="container-fluid">    
    <div class="row">
        <div class="col-md-1"> 
            <div class="logo">
                <img src="logo.png" class="img-fluid" alt="Responsive image">
            </div>
        </div> 
        
        <div class="col-md-8">   
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
                <div class="col-md-1" style="margin-top: 5.75%; padding-left: 6%"> 
                    <div class="b1">
                        <div class="btn-group">
                        <a href="shippersloginsession.php">
                        <button type="button" class="btn btn-primary">Home</button>
                        </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-1" style="padding-left: 6%"></div>
                
                <div class="col-md-5" style="margin-top: 3.75%; padding-left: 6%">
                    <form role="form" method="post" action="view_shippers.php">
                        <button type="submit" class="btn btn-block btn-lg btn-info">View / Ban Shippers</button>
                    </form>
                </div>                                
                
                <div class="col-md-5" style="margin-top: 3.75%; padding-left: 6%">
                    <form role="form" method="post" action="update_shippers.php">
                        <button type="submit" class="btn btn-block btn-lg btn-info">Update Shippers</button>
                    </form>
                </div>             
            </div>
        </nav>
        </div>
        
        <div class="container-fluid" style="margin-top: 2.5%">
        <form role="form" method="post" action="logout.php">
            <button type="submit" class="btn btn-default" 
                style="background-color: lightgray; color: black; border-color: black; margin-left: 3%">
            <span class="glyphicon glyphicon-log-out"></span> Log Out</button>
            <button type="button" class="btn btn-lg" onclick="settings()" 
                style="background-color: lightgray; color: black; margin-left: 5%">
            <span class="glyphicon glyphicon-cog"></span></button>
        </form>
        </div>
        
        <script type="text/javascript">
            function settings()
            {
                window.location.href = "changepassword.php";
            }
        </script>    
        
    </div>
           
    <div class="row">
        
        <div class="col-md-2"></div>
        
        <div class="col-md-8">
            <div class="container-fluid" style="padding-left: 4%; padding-right: 4%;
                 border: solid 4px blue; background-color: lightyellow">
                                                
                <form role="form" method="post" action="verifyshipperemail.php" style="padding-top: 2%; padding-bottom: 2%">                
                    
                    <h3 style="background-color: white"><center>Verify e-mail id to add Shipper</center></h3>
                
                    <div class="form-inline">
                        <label for="email"><span class="glyphicon glyphicon-envelope"></span> Email Id: </label>
                        <input type="email" class="form-control" name="email" placeholder="abc@gmail.com">
                        <button type="submit" class="btn btn-group">Verify</button>
                    </div>
                    
                </form>
                
                <form role="form" method="post" action="addshipper.php">
                    
                    <h3 style="background-color: white"><center>ADD SHIPPER</center></h3>
                    
                    <div class="form-inline">
                        <label for="email"><span class="glyphicon glyphicon-envelope"></span> Email Id: </label>
                        <input type="email" class="form-control" name="email" placeholder="abc@gmail.com">
                        <label for="code" style="padding-left: 5%"> Enter verification code: </label>
                        <input type="number" class="form-control" name="code">
                    </div>
                    
                    <br>
                
                    <div class="form-group">
                        <label for="name"><span class="glyphicon glyphicon-user"></span> Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Manasi Srivastava">
                    </div>
                                                           
                    <div class="form-group">
                        <label for="address"> Address with Pincode</label>
                        <input type="text" class="form-control" name="address" 
                               placeholder="House No., Building No., Area, City, State, Country - 211001">
                    </div>
                                        
                    <div class="form-group">
                        <label for="phone"><span class="glyphicon glyphicon-phone"></span> Mobile No.</label>
                        <input type="text" class="form-control" name="phone" placeholder="8337020976">
                    </div>
                
                    <button type="submit" name="action" class="btn btn-group btn-block" style="background-color: lightgray">
                        Submit</button>
                </form>        
            </div>
        </div>
    </div>
    </div>

   </body>
   
</html>