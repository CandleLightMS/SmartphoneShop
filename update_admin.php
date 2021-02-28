<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');
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
            <form role="form" method="post" action="adminloginsession.php">
            <button type="submit" class="btn btn-primary">
            Home</button>
            </form>
        </div>
        </div>
        
        <div class="col-md-7"></div>
                
        <div class="col-md-1" style="margin-top: 4%; margin-right: 5%"> 
        <div class="container-fluid">
        <form role="form" method="post" action="logout.php">
            <button type="submit" class="btn btn-default" 
                style="background-color: lightgray; color: black; border-color: black">
            <span class="glyphicon glyphicon-log-out"></span> Log Out</button>
        </form>
        </div>
        </div>
    </div>
        
        <br><br>
        
    <div class="row">
        <div class="col-md-3"></div>
        
        <div class="col-md-5" style="margin-left: 2%">
            <form role="form" method="post" action="update_a_login_id.php">
            <button type="submit" class="btn btn-block btn-info"
                    style="background-color: white; color: black; border-color: black; font-size: 18px; font-family: sans-serif">
            Update Login Id</button>
            </form>
        </div>
        
        <div class="col-md-3"></div>
    </div>
        
        <br><br>
    
    <div class="row">
        <div class="col-md-3"></div>
        
        <div class="col-md-5" style="margin-left: 2%">
            <form role="form" method="post" action="update_aname.php">
            <button type="submit" class="btn btn-block btn-info"
                    style="background-color: white; color: black; border-color: black; font-size: 18px; font-family: sans-serif">
            Update Name</button>
            </form>
        </div>
        
        <div class="col-md-3"></div>
    </div>
        
        <br><br>
        
    <div class="row">
        <div class="col-md-3"></div>
        
        <div class="col-md-5" style="margin-left: 2%">
            <form role="form" method="post" action="update_a_email.php">
            <button type="submit" class="btn btn-block btn-info"
                    style="background-color: white; color: black; border-color: black; font-size: 18px; font-family: sans-serif">
            Update E-mail Id</button>
            </form>
        </div>
        
        <div class="col-md-3"></div>
    </div>
        
        <br><br>

    <div class="row">
        <div class="col-md-3"></div>
        
        <div class="col-md-5" style="margin-left: 2%">
            <form role="form" method="post" action="changepassword.php">
                <button type="submit" class="btn btn-block btn-info" 
                        style="background-color: white; color: black; border-color: black; font-size: 18px; font-family: sans-serif">
            Change Password</button>
            </form>
        </div>
        
        <div class="col-md-3"></div>
    </div>

   </body>
   
</html>