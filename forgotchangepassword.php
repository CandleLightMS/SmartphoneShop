<?php

include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$login_id = $_GET['login_id'];

if(isset($_POST['submitbtn']))
{    
    $flag = 0;
    
    if(empty($_POST['new_pwd'] || $_POST['confirm_pwd']))
    {
        $flag =1;
                
        header("refresh: 0; url=forgotpassword.php");
    }
    
    $npwd = $_POST['new_pwd'];
    $cpwd = $_POST['confirm_pwd'];
    
    if($npwd != $cpwd)
    {
        echo '<script language="javascript">';
        echo 'alert("Passwords do not match.")';
        echo '</script>';
            
        $flag=1;
        
        header("refresh: 0; url=forgotpassword.php");
    }
    
    if($flag==0)
    {
        mysqli_query($conn, "UPDATE login SET password = '$npwd' WHERE login_id = '$login_id'");
        
        echo '<script language="javascript">
            alert("Your password has been changed. Login with new password.");
            </script>';
        
        header("refresh: 0; url=index.php");
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
        
        <div class="col-md-2"></div>        
        
        <div class="col-md-1"></div>
        
        <div class="col-md-4" style="margin-top: 12%; margin-left: 10%; background-color: lightyellow; border: solid 5px lightgray">
            
            <form role="form" method="post" action="">
            
            <h2>Change Password</h2>
            
            <label for="new_pwd"> Enter New Password</label>
            <input type="password" class="form-control" name="new_pwd">            
            
            <br>
            
            <label for="confirm_pwd"> Confirm Password</label>
            <input type="password" class="form-control" name="confirm_pwd">            
            
            <br>
            
            <button type="submit" class="btn btn-group" name ="submitbtn" style="border-color: lightgray">Update</button>
            </form>
            
        </div>
        
    </div>        
    </div>

   </body>
   
</html>