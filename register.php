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
        
        <style>
            .c1
            {
                padding-top: 20%;
            }
        </style>
        
        <script>
        
            $(document).ready(function()
            {
                $("#c").click(function()
                {
                    $("#signupmodal").modal();
                });
            });
            
            $(document).ready(function()
            {
                $("#s").click(function()
                {
                    $("#signupseller").modal();
                });
            });
        
        </script>
    </head>
        
    <body>
        <div class="container-fluid">
            <div class="row">
                <!-- Modal -->
        <div class="modal fade" id="signupmodal" role="dialog">
            <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" style="background-color: lightyellow">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="color:red;"><span class="glyphicon glyphicon-pencil"></span> Sign Up</h4>
            </div>
        
            <div class="modal-body">
                <form role="form" method="post" action="signup.php">
                    <div class="form-group">
                        <label for="name"><span class="glyphicon glyphicon-user"></span> Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Manasi Srivastava">
                    </div>
                                                           
                    <div class="form-group">
                        <label for="address"> Address</label>
                        <input type="text" class="form-control" name="address" placeholder="House No., Building No., Area, City, State, Country">
                    </div>
                    
                    <div class="form-group">
                        <label for="pincode"> Pincode</label>
                        <input type="text" class="form-control" name="pincode" placeholder="211001">
                    </div>
                    
                    <div class="form-group">
                        <label for="phone"><span class="glyphicon glyphicon-phone"></span> Mobile No.</label>
                        <input type="text" class="form-control" name="phone" placeholder="8337020976">
                    </div>
                    
                    <div class="form-group">
                        <label for="lid"><span class="glyphicon glyphicon-user"></span> Login Id</label>
                        <input type="text" class="form-control" name="lid" placeholder="Maansi08">
                    </div>
                    
                    <div class="form-group">
                        <label for="email"><span class="glyphicon glyphicon-envelope"></span> Email</label>
                        <input type="email" class="form-control" name="email" placeholder="abc@gmail.com">
                    </div>
                    
                    <div class="form-group">
                        <label for="password"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                        <input type="password" class="form-control" name="spwd" placeholder="passwordexample01">
                    </div>
                    
                    <div class="form-group">
                        <label for="psw-repeat"><span class="glyphicon glyphicon-repeat"></span> Confirm Password</label>
                        <input type="password" class="form-control" name="cspwd" placeholder="passwordexample01">
                    </div>
                    
                    <button type="submit" class="btn btn-default btn-block" style="background-color: lightgray">Submit</button>
                </form>
            </div>
            
            <div class="modal-footer">
                <p style="color: blue; font-size: 25px">
                    By creating an account you agree to our <a href="tosandpp.php" style="color:red">
                        Terms of Service & Privacy Policy</a>.
                </p>
            </div>
            
            </div>
            </div>
        </div>
                
        <div class="modal fade" id="signupseller" role="dialog">
            <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" style="background-color: lightyellow">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="color:red;"><span class="glyphicon glyphicon-pencil"></span> Sign Up</h4>
            </div>
        
            <div class="modal-body">
                <form role="form" method="post" action="signupseller.php">
                    <div class="form-group">
                        <label for="name"><span class="glyphicon glyphicon-user"></span> Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Manasi Srivastava">
                    </div>
                                                           
                    <div class="form-group">
                        <label for="address"> Address</label>
                        <input type="text" class="form-control" name="address" placeholder="House No., Building No., Area, City, State, Country">
                    </div>
                    
                    <div class="form-group">
                        <label for="pincode"> Pincode</label>
                        <input type="text" class="form-control" name="pincode" placeholder="211001">
                    </div>
                    
                    <div class="form-group">
                        <label for="phone"><span class="glyphicon glyphicon-phone"></span> Mobile No.</label>
                        <input type="text" class="form-control" name="phone" placeholder="8337020976">
                    </div>
                    
                    <div class="form-group">
                        <label for="lid"><span class="glyphicon glyphicon-user"></span> Login Id</label>
                        <input type="text" class="form-control" name="lid" placeholder="Maansi08">
                    </div>
                    
                    <div class="form-group">
                        <label for="email"><span class="glyphicon glyphicon-envelope"></span> Email</label>
                        <input type="email" class="form-control" name="email" placeholder="abc@gmail.com">
                    </div>
                    
                    <div class="form-group">
                        <label for="password"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                        <input type="password" class="form-control" name="spwd" placeholder="passwordexample01">
                    </div>
                    
                    <div class="form-group">
                        <label for="psw-repeat"><span class="glyphicon glyphicon-repeat"></span> Confirm Password</label>
                        <input type="password" class="form-control" name="cspwd" placeholder="passwordexample01">
                    </div>
                    
                    <button type="submit" class="btn btn-default btn-block" style="background-color: lightgray">Submit</button>
                </form>
            </div>
            
            <div class="modal-footer">
                <p style="color: blue; font-size: 25px">
                    By creating an account you agree to our <a href="tosandpp.php" style="color:red">
                        Terms of Service & Privacy Policy</a>.
                </p>
            </div>
            
            </div>
            </div>
        </div>                
            </div>
            
            
            <div class="container-fluid">
                
                <div class="row">
                <div class="col-md-12"> <div class="c1"></div> </div>
                </div>
                
                <div class="row">
                    
                    <div class="col-md-2"> </div>
                    
                    <div class="col-md-5"> 
                        <div class="b1" id="c">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-lg">Sign Up as a Customer</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-5"> 
                        <div class="b1" id="s">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-lg">Sign Up as a Seller</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-0"> </div>
                    
                </div>             
            </div>
        </div>        
    </body>
        
</html>