<?php

include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$user_id = $_GET['login_id'];

$code_query = mysqli_query($conn, "SELECT code FROM verify WHERE login_id = '$user_id'");
$code_array = mysqli_fetch_row($code_query);
$code = $code_array[0];

if(isset($_POST['submitbtn']))
{
    if(!empty($_POST['code']))
    {
        if($code == $_POST['code'])
        {
            mysqli_query($conn, "UPDATE verify SET status = 1 WHERE login_id = '$user_id'");
        }
    }
    
    header("location: index.php");
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
            <form role="form" method="post" action="index.php">
            <button type="submit" class="btn btn-primary">
            Home</button>
            </form>
        </div>
        </div>        
        
        <div class="col-md-1"></div>
        
        <div class="col-md-4" style="margin-top: 10%; margin-left: 5%; background-color: lightyellow; border: solid 5px lightgray">
            
            <form role="form" method="post" action="">
            
            <h2>Enter verification code:</h2>            
                        
            <input type="text" class="form-control" name="code">            
            
            <br>
            
            <button type="submit" class="btn btn-group" name ="submitbtn" style="border-color: lightgray">Submit</button>
            </form>
            
        </div>
        
    </div>        
    </div>

   </body>
   
</html>