<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$user_type = mysqli_fetch_row(mysqli_query($conn, "SELECT user_type from login where login_id= '$_SESSION[login_user]'"));
        
if($user_type[0]=='A')
{
    $name = mysqli_fetch_row(mysqli_query($conn, "SELECT a_name from admin where login_id= '$_SESSION[login_user]'"));    
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
            
                <div class="col-md-2" style="margin-top: 6%"> 
                    <div class="b1">
                        <div class="btn-group">
                            <a href="adminloginsession.php">
                            <button type="button" class="btn btn-primary">Home</button>
                            </a>
                        </div>
                    </div>
                </div>         
                       
                <div class="col-md-2" style="margin-top: 6%">
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
                                      
                <div class="col-md-4" style="margin-top: 6%">
                    <form class="form-inline" id="f" action="search.php" method="post">
                        <div class="container">                            
                            <input class="form-control" type="search" placeholder="search" name="search">
                            <button class="btn btn-default" type="submit">
                            <span class="glyphicon glyphicon-search"></span></button>
                        </div>
                    </form>
                </div>
                    
                <div class="col-md-4" style="margin-top: 2%; padding-left: 40px">
                    <br>
                    <form role="form" method="post" action="authorisesellers.php">
                    <button type="submit" class="btn btn-info btn-lg" 
                            style="background-color: white; color: black; border-color: darkblue; border-width: 2px">
                    Authorise Sellers <span class="glyphicon glyphicon-check"></span></button>               
                    </form>        
                </div>        
            </div>
        </nav>
        </div>
        
        <div class="container-fluid" style="margin-top: 3%">
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
                window.location.href = "update_admin.php";
            }
        </script>    
                         
    </div>        
    </div>
       
    <div class="container-fluid">
    <div class="row">
    
        <div class="col-md-12" style="margin-bottom: 5%"></div>
        
        <div class="col-md-2"></div>
        
        <div class="col-md-4">
            <div class="container-fluid">        
                <form role="form" method="post" action="update_best_offers.php">
                <button type="submit" class="btn btn-block btn-group" 
                        style="background-color: lightyellow; color: black; border-color: black; border-width: 2px; font-size: 20px">
                Update Best Offers</button>               
                </form>    
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="container-fluid">        
                <form role="form" method="post" action="update_latest_launches.php">
                <button type="submit" class="btn btn-group btn-block" 
                        style="background-color: lightyellow; color: black; border-color: black; border-width: 2px; font-size: 20px">
                Update Latest Launches</button>               
                </form>    
            </div>
        </div>
        
        <div class="col-md-2"></div>
        
    </div>
    
    <div class="row">
        
        <div class="col-md-12" style="margin-bottom: 2%"></div>
        
        <div class="col-md-2"></div>
        
        <div class="col-md-4">
            <div class="container-fluid">        
                <form role="form" method="post" action="view_customers.php">
                <button type="submit" class="btn btn-block btn-group" 
                        style="background-color: lightyellow; color: black; border-color: black; border-width: 2px; font-size: 20px">
                View All / Ban Customers</button>               
                </form>    
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="container-fluid">        
                <form role="form" method="post" action="view_sellers.php">
                <button type="submit" class="btn btn-group btn-block" 
                        style="background-color: lightyellow; color: black; border-color: black; border-width: 2px; font-size: 20px">
                View All / Ban Sellers</button>               
                </form>    
            </div>
        </div>
        
    </div>
        
    <div class="row">
        
        <div class="col-md-12" style="margin-bottom: 6%"></div>
        
        <div class="col-md-2"></div>
        
        <div class="col-md-4">
            <div class="container-fluid">        
                <form role="form" method="post" action="salestoday.php">
                <button type="submit" class="btn btn-info btn-block" 
                        style="font-size: 20px; color: darkblue; border-color: darkblue; border-width: 2px; 
                        background-color: lightblue">
                Today's Sales</button>               
                </form>    
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="container-fluid">        
                <form role="form" method="post" action="monthlysales.php">
                <button type="submit" class="btn btn-info btn-block" 
                        style="font-size: 20px; color: darkblue; border-color: darkblue; border-width: 2px; 
                        background-color: lightblue">
                Monthly Sales</button>               
                </form>    
            </div>
        </div>
    </div>
                    
    <div class="row">
        
        <div class="col-md-12" style="margin-bottom: 2%"></div>
        
        <div class="col-md-2"></div>
        
        <div class="col-md-4">
            <div class="container-fluid">        
                <form role="form" method="post" action="yearlysales.php">
                <button type="submit" class="btn btn-info btn-block" 
                        style="font-size: 20px; color: darkblue; border-color: darkblue; border-width: 2px; 
                        background-color: lightblue">
                Yearly Sales</button>               
                </form>    
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="container-fluid">        
                <form role="form" method="post" action="modelwisesales.php">
                <button type="submit" class="btn btn-info btn-block" 
                        style="font-size: 20px; color: darkblue; border-color: darkblue; border-width: 2px; 
                        background-color: lightblue">
                Model-Wise Sales</button>               
                </form>    
            </div>
        </div>        
    </div>           
    </div>

   </body>    
</html>