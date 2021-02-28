<?php

session_start();
include("config.php");

mysqli_select_db($conn, 'smartphone_shop');
   
$_SESSION['login_user'] = $_POST['lid']; // Initializing Session with value of PHP Variable
$_SESSION['pass'] = $_POST['pwd'];

$query = mysqli_query($conn, "select * from login where password='$_SESSION[pass]' AND login_id='$_SESSION[login_user]'");
$rows = mysqli_num_rows($query);

$isDeleted = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM deleted_accounts WHERE login_id = '$_SESSION[login_user]'"));

if($isDeleted>0)
{
    echo '<script language="javascript">';
    echo 'alert("Login Id or Password is incorrect.")';
    echo '</script>';
    
    header("refresh: 0; url=index.php");
}
else
{
    $isBanned = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM banned_users WHERE login_id = '$_SESSION[login_user]'"));
        
    if($isBanned>0)
    {
        echo '<script language="javascript">';
        echo 'alert("You are banned from accessing your account.")';
        echo '</script>';
    
        header("refresh: 0; url=index.php");
    }
    else if ($rows == 1)
    {   
        header("location: loginsession.php"); // Redirecting To Other Page
    }
    else
    {    
        $error = "Login Id or Password is incorrect.";      
        echo '
        <link href = "home.css" rel = "stylesheet"/>
        <script language="javascript">
        alert("'. $error .'")
        </script>';
        header ("refresh:0; url=index.php");
    }
}

mysqli_close($conn); // Closing Connection