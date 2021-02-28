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

/*$phone_status_array = mysqli_fetch_row(mysqli_query($conn, "SELECT status from verify_phone where login_id= '$login_id'"));
$phone_status = $phone_status_array[0];

$phone_code_array = mysqli_fetch_row(mysqli_query($conn, "SELECT code from verify_phone where login_id= '$login_id'"));
$phone_code = $phone_code_array[0];

if($phone_status==0 && $phone_code==0)
{
    echo '<p style="text-align: center; background-color: lightblue; color: black; font-size: 14px">'
    . 'To verify your phone number <a href="verifyphone.php?login_id='.$login_id.'">click here.</a></p>';    
}
else if($phone_status==0 && $phone_code!=0)
{
    echo '<p style="text-align: center; background-color: lightblue; color: black; font-size: 14px">'
    . 'OTP has been sent.<a href="verifyphone.php?login_id='.$login_id.'"> Click here</a>'
            . ' to verify.</p>';    
}*/

$user_type = mysqli_fetch_row(mysqli_query($conn, "SELECT user_type from login where login_id= '$_SESSION[login_user]'"));
        
if($user_type[0]=='C')
{    
    $name = mysqli_fetch_row(mysqli_query($conn, "SELECT u_name from customer where login_id= '$_SESSION[login_user]'"));
}
else if($user_type[0]=='S')
{    
    header("location: sellerloginsession.php");
}
else if($user_type[0]=='D')
{
    header("location: shippersloginsession.php");
}
else if($user_type[0]=='A')
{
    header("location: adminloginsession.php");
}

$_SESSION['login_type']=$user_type[0];
        
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
                            <a href="loginsession.php">
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
                    
                <div class="col-md-1"></div>
                
                <div class="col-md-2" style="margin-top: 3.5%">
                    <form role="form" method="post" action="mycart.php">
                        <button type="submit" class="btn btn-primary btn-lg" style="background-color: white; color: black; border-color: yellow">
                        <span class="glyphicon glyphicon-shopping-cart"></span> My Cart</button>               
                    </form>
                </div>             
            </div>
        </nav>
        </div>
        
        <div class="container-fluid" style="margin-top: 2.5%">
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
                window.location.href = "update_customer.php";
            }
        </script>    
                 
    </div>        
    </div>       
    
    <div class="container-fluid">
    <div class="row">
                
        <div class="col-md-9" style="margin-top: 2%"> 	
            <div class="sshow"> 	
                        
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                        <li data-target="#myCarousel" data-slide-to="4"></li>
                        <li data-target="#myCarousel" data-slide-to="5"></li>
                        <li data-target="#myCarousel" data-slide-to="6"></li>
                        <li data-target="#myCarousel" data-slide-to="7"></li>
                        <li data-target="#myCarousel" data-slide-to="8"></li>
                        <li data-target="#myCarousel" data-slide-to="9"></li>
                        <li data-target="#myCarousel" data-slide-to="10"></li>
                        <li data-target="#myCarousel" data-slide-to="11"></li>
                        <li data-target="#myCarousel" data-slide-to="12"></li>
                        <li data-target="#myCarousel" data-slide-to="13"></li>
                        <li data-target="#myCarousel" data-slide-to="14"></li>
                    </ol>
                           
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                               
                        <div class="item active">
                            <img src="sh1.jpg" alt="New Deals">
                        </div>
                                
                        <div class="item">
                            <img src="sh2.jpg" alt="Smartphones for you!">
                        </div>
                                
                        <div class="item">
                            <img src="sh3.jpg" alt="Image 3">
                        </div>
                                
                        <div class="item">
                            <img src="sh14.jpg" alt="Image 4">
                        </div>
                                
                        <div class="item">
                            <img src="sh4.jpg" alt="Image 5">
                        </div>
                                
                        <div class="item">
                            <img src="sh13.jpg" alt="Image 6">
                        </div>
                                
                        <div class="item">
                            <img src="sh5.jpg" alt="Image 7">
                        </div>
                                
                        <div class="item">
                            <img src="sh12.jpg" alt="Image 8">
                        </div>
                                
                        <div class="item">
                            <img src="sh6.jpg" alt="Image 9">
                        </div>
                                
                        <div class="item">
                            <img src="sh11.jpg" alt="Image 10">
                        </div>
                                
                        <div class="item">
                            <img src="sh10.jpg" alt="Image 11">
                        </div>
                                
                        <div class="item">
                            <img src="sh7.jpg" alt="Image 12">
                        </div>
                                
                        <div class="item">
                            <img src="sh9.jpg" alt="Image 13">
                        </div>   
                                
                    </div>                          
                    
                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                        
            </div>
        </div>
                
        </br> <br>
                
        <div class="col-md-3" style="margin-left: -20px"> 
            <div class="circ">
                                
                <div class="btn-group">
                    <h1 style="color: yellow; font-family: sans-serif; font-size: 35px">Deals of the Day</h1>
                </div>
                                                                           
                <div class="list-group">
                <br/>
                                
                <a href="view_bestoffers.php" class="list-group-item active" style="border-color: lightgray">
                Best Offers</a>
                <br/>
                                
                <a href="view_latestlaunches.php" class="list-group-item active" style="border-color: lightgray">
                Latest Launches</a>		
                </div>
                
                <br> <br>
                  
                <div class="col-md-14" style="margin-top: 5%">
                    <form action="filtersmartphones_form.php">
                    <button type="submit" class="btn btn-info btn-lg btn-block" 
                            style="text-align: center; color: black; background-color: lightgray; border-color: darkblue">
                        Filter Smartphones for Me</button>
                    </form>
                </div>
                
                <br> <br>
                                
                <div class="col-md-14" style="margin-top: 3.5%">
                    <form role="form" method="post" action="myorders.php">
                        <button type="submit" class="btn btn-primary btn-block btn-lg" 
                                style="font-size: 16px; background-color: white; color: black; border-color: yellow">
                        My Orders</button>               
                    </form>
                </div>         
                                                    
            </div>
        </div>
    </div> 		
    </div>

   </body>
   
</html>