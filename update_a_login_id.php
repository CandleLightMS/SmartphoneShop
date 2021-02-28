<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$user_id = $_SESSION['login_user'];

if(isset($_POST['submitbtn']))
{
    $login_id = $_POST['login_id'];
    
    $flag = 0;
    
    if(empty($_POST['login_id']))
    {
        $flag = 1;
    }
    
    $slquery = "SELECT * FROM login WHERE login_id = '$login_id'";
    $selectresult = mysqli_query($conn, $slquery);
    if(mysqli_num_rows($selectresult)>0 && $login_id!=$user_id)
    {
        echo '<script language="javascript">';
        echo 'alert("This login id already exists.")';
        echo '</script>';
            
        $flag = 1;
    }    
    
    if($flag==0)
    {
        mysqli_query($conn, "UPDATE login SET login_id = '$login_id' WHERE login_id = '$user_id'");
        mysqli_query($conn, "UPDATE admin SET login_id = '$login_id' WHERE login_id = '$user_id'");
        
        echo '<script language="javascript">';
        echo 'alert("Login Id updated. Please login again (with new id).")';
        echo '</script>';
        
        header("refresh:0; url=index.php");
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
            <form role="form" method="post" action="adminloginsession.php">
            <button type="submit" class="btn btn-primary">
            Home</button>
            </form>
        </div>
        </div>        
        
        <div class="col-md-1"></div>
        
        <div class="col-md-4" style="margin-top: 10%; margin-left: 5%; background-color: lightyellow; border: solid 5px lightgray">
            
            <form role="form" method="post" action="">
            
            <h2>Update Login Id</h2>            
            
            <label for="email"> Login Id</label>
            <input type="text" class="form-control" name="login_id" value="<?php echo $user_id; ?>">            
            
            <br>
            
            <button type="submit" class="btn btn-group" name ="submitbtn" style="border-color: lightgray">Update</button>
            </form>
            
        </div>
        
    </div>        
    </div>

   </body>
   
</html>