<html>
   <head>
        <link href = "home.css" rel = "stylesheet"/>
   </head>
</html>

<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$login_id=$_SESSION['login_user'];

$slquery1 = "SELECT * FROM authorisation_requests WHERE login_id = '$login_id'";
$selectresult1 = mysqli_query($conn, $slquery1);

$slquery2 = "SELECT * FROM authorised_sellers WHERE login_id = '$login_id'";
$selectresult2 = mysqli_query($conn, $slquery2);

$flag=0;

if(mysqli_num_rows($selectresult1)>0)
{
    echo '<script language="javascript">';
    echo 'alert("You have already sent authorisation request.")';
    echo '</script>';
            
    $flag=1;
}

if(mysqli_num_rows($selectresult2)>0)
{
    echo '<script language="javascript">';
    echo 'alert("You are already authorised to sell products on Smartphone Shop.")';
    echo '</script>';
            
    $flag=1;
}

if($flag==0)
{
    $status_array = mysqli_fetch_row(mysqli_query($conn, "SELECT status from verify where login_id= '$_SESSION[login_user]'"));
    $status = $status_array[0];
    
    if($status==0)
    {
        echo '<script language="javascript">'
        . 'alert("To send authorisation request for selling products on Smartphone Shop you must verify your e-mail id, '
            . 'activate your account & then log in again.")'
        . '</script>';
        
        $flag=1;
        
        header("refresh:0; url=sellerloginsession.php");
    }
}

if($flag==0)
{
    $sql=mysqli_query($conn, "INSERT INTO authorisation_requests (login_id) VALUES ('$_SESSION[login_user]')");

    if ($sql == TRUE) 
    {        
        echo '<script language="javascript">';
        echo 'alert("Sent authorisation request.")';
        echo '</script>';
    }
    else
    {
        echo '<script language="javascript">';
        echo 'alert("Authorisation request could not be sent.")';
        echo '</script>';
    }
}

header("refresh:0; url=sellerloginsession.php");

$conn->close();
?>