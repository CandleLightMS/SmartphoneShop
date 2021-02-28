<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Smartphone Shop</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <link href = "home.css" rel = "stylesheet"/>
        
        <script>
            $(document).ready
            (
                function()
                {
                    $('.signup').click
                    (
                        function()
                        {
                            window.location.href = "register.php";					
                        }
                    );		
                }
            );
    
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
    
            $(document).ready(function()
            {
                $("#loginbtn").click(function()
                {
                    $("#loginmodal").modal();
                });
                
                $("#loginbtn2").click(function()
                {
                    $("#loginmodal").modal();
                });
            });
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
            
                <div class="col-md-2" style="margin-top: 2%"> 
                    <div class="b1">
                        <div class="btn-group">
                            <a href="index.php">
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
                                      
                <div class="col-md-4" style="margin-top: 4%">
                    <form class="form-inline" id="f" action="search.php" method="post">
                        <div class="container">
                        <input class="form-control" type="search" placeholder="search" name="search">                                                            
                        <button class="btn btn-default" type="submit">
                            <span class="glyphicon glyphicon-search"></span></button>
                        </div>
                    </form>
                </div>
                
                <div class="col-md-1"></div>
                
                <div class="col-md-2" style="margin-top: 4%">
                    <form role="form" method="post" action="addtocart.php">
                        <button type="submit" class="btn btn-primary btn-lg" style="background-color: white; color: black; border-color: yellow">
                        <span class="glyphicon glyphicon-shopping-cart"></span> Cart</button>               
                    </form>
                </div>             
            </div>
        </nav>
        </div>
            
        
        <div class="container-fluid">
            	
        <div class="login" style="margin-top: 2%">
        <button type="button" class="btn btn-success btn-lg" id="loginbtn">Log In</button>
        </div>          
  
        <!-- Modal -->
        <div class="modal fade" id="loginmodal" role="dialog">
            <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" style="background-color: lightyellow">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="color:red;"><span class="glyphicon glyphicon-lock"></span> Log In</h4>
            </div>
        
            <div class="modal-body">
                <form role="form" method="post" action="login.php">
                    <div class="form-group">
                        <label for="lid"><span class="glyphicon glyphicon-user"></span> Login Id</label>
                        <input type="text" class="form-control" name="lid" placeholder="Maansi08">
                    </div>
                    
                    <div class="form-group">
                        <label for="password"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                        <input type="password" class="form-control" name="pwd" placeholder="Enter password">
                    </div>
                    
                    <button type="submit" class="btn btn-default btn-success btn-block">
                    <span class="glyphicon glyphicon-log-in"></span> Log In</button>
                </form>
            </div>
            
            <div class="modal-footer">
                <p style="color: blue">Not a member? <a href="register.php" style="color: red">Sign Up</a></p>
                <p style="color: blue">Forgot <a href="forgotpassword.php">Password?</a></p>
            </div>
            
            </div>
            </div>
        </div> 
                    
        <div class="container-fluid">
        
        <div class="signup" style="margin-top: 1.5%">
        <button type="button" class="btn btn-success btn-lg" id="signupbtn" style="background-color: lightyellow; color: darkblue">Sign Up</button>
        </div>          
        </div>
                 
        </div>
        
    </div>
    </div>    
           
    <div class="container-fluid">
    <div class="row">
                
        <div class="col-md-9"> 	
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
                
        </br> </br>
                
        <div class="col-md-3" style="margin-left: -20px"> 
            <div class="circ">
                        
                <div class="btn-group">
                    <h1 style="color: yellow; font-family: sans-serif; font-size: 35px;">Deals of the Day</h1>
                </div>
                                                                           
                <div class="list-group">
                <br/>
                                
                <a href="view_bestoffers.php" class="list-group-item active" style="border-color: lightgray">
                Best Offers</a>
                <br/>
                                
                <div class="list-group-item" style="background-color: lightyellow">
                Get 10% off with SBI Debit/Credit Card</div>
                <br/>
                                
                <div class="list-group-item" style="background-color: lightyellow">
                Get 2% off with HDFC Debit/Credit Card
                </div>
                <br/>
                                
                <a href="view_latestlaunches.php" class="list-group-item active" style="border-color: lightgray">
                Latest Launches</a>		
                </div>
                
                <br>
                        
                <div class="col-md-14" style="margin-top: 5%">
                    <button type="button" class="btn btn-info btn-block btn-lg" id="loginbtn2"
                            style="text-align: center; color: black; background-color: lightgray; border-color: darkblue">
                        Filter Smartphones for Me</button>
                </div>
                        
            </div>
        </div>
    </div> 		
    </div>
        
    </body>
</html>
