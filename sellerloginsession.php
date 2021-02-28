<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$login_id = $_SESSION['login_user'];

$status_array = mysqli_fetch_row(mysqli_query($conn, "SELECT status from verify where login_id= '$login_id'"));
$status = $status_array[0];

$code_array = mysqli_fetch_row(mysqli_query($conn, "SELECT code from verify where login_id= '$login_id'"));
$code = $code_array[0];

if($status==0 && $code==0)
{
    echo '<p style="text-align: center; background-color: lightpink; color: black; font-size: 14px">'
    . 'To verify your email id <a href="verifymyemail.php?login_id='.$login_id.'">click here.</a></p>';    
}
else if($status==0 && $code!=0)
{
    echo '<p style="text-align: center; background-color: lightpink; color: black; font-size: 14px">'
    . 'E-mail verification link has been sent.<a href="verifymyemail.php?login_id='.$login_id.'"> Click here</a>'
            . ' to send the link again.</p>';    
}

$user_type = mysqli_fetch_row(mysqli_query($conn, "SELECT user_type from login where login_id= '$_SESSION[login_user]'"));
        
if($user_type[0]=='S')
{
    $name = mysqli_fetch_row(mysqli_query($conn, "SELECT s_name from seller where login_id= '$_SESSION[login_user]'"));    
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
            echo "<title>You are logged in as " . $name[0] . ". </title>";
        ?>
        <link href = "home.css" rel = "stylesheet"/>
        
        <script>
            $(document).ready
            (
                function()
                {
                    $('#g').click
                    (
                        function()
                        {
                            window.location.href = "searchbrand.php?link=Google";					
                        }
                    );
            
                    $('#s').click
                    (
                        function()
                        {
                            window.location.href = "searchbrand.php?link=Samsung";					
                        }
                    );
            
                    $('#a').click
                    (
                        function()
                        {
                            window.location.href = "searchbrand.php?link=Apple";					
                        }
                    );

                    $('#v').click
                    (
                        function()
                        {
                            window.location.href = "searchbrand.php?link=Vivo";					
                        }
                    );

                    $('#o').click
                    (
                        function()
                        {
                            window.location.href = "searchbrand.php?link=Oppo";					
                        }
                    );

                    $('#ho').click
                    (
                        function()
                        {
                            window.location.href = "searchbrand.php?link=Honor";					
                        }
                    );

                    $('#x').click
                    (
                        function()
                        {
                            window.location.href = "searchbrand.php?link=Xiaomi";					
                        }
                    );
            
                    $('#hw').click
                    (
                        function()
                        {
                            window.location.href = "searchbrand.php?link=Huawei";					
                        }
                    );

                    $('#oth').click
                    (
                        function()
                        {
                            window.location.href = "searchbrand.php?link=Others";					
                        }
                    );
                }
            );
        </script>
   </head>
   
   <body>
       
       <!--/**-->
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
            
                <div class="col-md-2" style="margin-top: 5%"> 
                    <div class="b1">
                        <div class="btn-group">
                            <a href="sellerloginsession.php">
                            <button type="button" class="btn btn-primary">Home</button>
                            </a>
                        </div>
                    </div>
                </div>         
                       
                <div class="col-md-2" style="margin-top: 5%">
                            <select class="form-control" id="brand">
                                <option><h1>BRANDS</h1></option>
                                <option id="g">Google</option>
                                <option id="s">Samsung</option>
                                <option id="a">Apple</option>
                                <option id="v">Vivo</option>
                                <option id="o">Oppo</option>
                                <option id="ho">Honor</option>
                                <option id="x">Xiaomi</option>
                                <option id="hw">Huawei</option>
                                <option id="oth">Others</option>
                            </select>
                </div>
                                      
                <div class="col-md-4" style="margin-top: 4.4%">
                    <form class="form-inline" id="f" action="search.php" method="post">
                        <div class="container">                            
                            <input class="form-control" type="search" placeholder="search" name="search">
                            <button class="btn btn-lg" type="submit">
                            <span class="glyphicon glyphicon-search"></span></button>
                        </div>
                    </form>
                </div>
                    
                <div class="col-md-4" style="margin-top: 1.4%; padding-left: 40px">
                    <br>
                    <?php
                    $slquery = "SELECT * FROM authorised_sellers WHERE login_id = '$_SESSION[login_user]'";
                    $selectresult = mysqli_query($conn, $slquery);

                    if(mysqli_num_rows($selectresult)>0)
                    {
                        echo'
                        <form role="form" method="post" action="addproduct.php">
                        <button type="submit" class="btn btn-info btn-lg" style="background-color: lightyellow; color: black">
                        <span class="glyphicon glyphicon-plus"></span> Add Product</button>               
                        </form>';
                    }
                    else
                    {
                        echo'
                            <form action="#" onsubmit="return myFun();">
                        <button type="submit" class="btn btn-info btn-lg"
                        style="background-color: lightyellow; color: black">
                        <span class="glyphicon glyphicon-plus"></span> Add Product</button></form>
                        
                        <script ="javascript">
                        function myFun()
                        {
                            alert("You are not authorised to sell.");
                        }
                        </script>
                        ';
                    }
                    ?>
                </div>        
            </div>
        </nav>
        </div>
        
        <div class="container-fluid" style="margin-top: 2.4%">
        <form role="form" method="post" action="logout.php">
            <button type="submit" class="btn btn-default" 
                style="background-color: lightgray; color: black; border-color: black">
            <span class="glyphicon glyphicon-log-out"></span> Log Out</button>
            <button type="button" class="btn btn-lg" onclick="settings()" 
                style="background-color: lightgray; color: black; margin-left: 5%">
            <span class="glyphicon glyphicon-cog"></span></button>
        </form>
        </div>
        
        <script type="text/javascript">
            function settings()
            {
                window.location.href = "update_seller.php";
            }
        </script>    
        
    </div>
           
    <div class="row">
        
        <div class="col-md-12" style="margin-bottom: 5%"></div>
        
        <div class="col-md-2"></div>
        
        <div class="col-md-4">
        <div class="container-fluid">        
        <form role="form" method="post" action="requestauthorisation.php">
           <button type="submit" class="btn btn-default btn-block" style="background-color: lightyellow; color: black; border-color: black">
           <span class="glyphicon glyphicon-check"></span> Send Authorisation Request</button>               
        </form>    
        </div>
        </div>
        
        <div class="col-md-4">
        <div class="container-fluid">        
        <form role="form" method="post" action="yourproducts.php">
           <button type="submit" class="btn btn-default btn-block" style="background-color: lightyellow; color: black; border-color: black">
           <span class="glyphicon glyphicon-list"></span> View / Update Your Products</button>               
        </form>    
        </div>
        </div>
    </div>

    <div class="row">
        
        <div class="col-md-12" style="margin-bottom: 5%"></div>
        
        <div class="col-md-2"></div>
        
        <div class="col-md-8">
        <div class="container-fluid" style="background-color: lightyellow; font-family: sans-serif">       
            <?php
            $slquery1 = "SELECT * FROM authorised_sellers WHERE login_id = '$_SESSION[login_user]'";
            $selectresult1 = mysqli_query($conn, $slquery1);
            
            $slquery2 = "SELECT * FROM authorisation_requests WHERE login_id = '$_SESSION[login_user]'";
            $selectresult2 = mysqli_query($conn, $slquery2);

            if(mysqli_num_rows($selectresult1)>0)
            {
                echo '<h4 style="text-align: center">
                You are authorised to sell products on Smartphone Shop.
                </h4>';
            }
            else if(mysqli_num_rows($selectresult2)>0)
            {
                echo '<h4 style="text-align: center">
                Your request for authorisation has been received. We will respond to you shortly.
                </h4>';
            }
            else
            {
                echo '<h4 style="text-align: center">
                You are not authorised to sell. Send authorisation request.
                </h4>';
            }
            ?>
        </div>
        </div>
    </div>
           
    <div class="row">
        
        <div class="col-md-12" style="margin-bottom: 8%"></div>
        
        <div class="col-md-4"></div>
        
        <div class="col-md-4">
            <div class="container-fluid">        
                <form role="form" method="post" action="ordersreceived.php">
                    <button type="submit" class="btn btn-lg btn-primary btn-block" 
                            style="color: black; border-color: blue; background-color: white">
                        Orders Received</button>               
            </form>    
            </div>
        </div>               

    </div>

   </body>
   
</html>