<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

include 'C:\wamp64\www\PHPMailer.php';
include 'C:\wamp64\www\SMTP.php';
include 'C:\wamp64\www\Exception.php';
include 'C:\wamp64\www\OAuth.php';
include 'C:\wamp64\www\POP3.php';

$login_id = $_GET['login_id'];

$code = rand(100000, 999999);

mysqli_query($conn, "UPDATE verify SET code = $code WHERE login_id = '$login_id'");

$user_type = mysqli_fetch_row(mysqli_query($conn, "SELECT user_type from login where login_id= '$login_id'"));
        
if($user_type[0]=='C')
{    
    $email_array = mysqli_fetch_row(mysqli_query($conn, "SELECT u_email from customer where login_id= '$login_id'"));
    $email = $email_array[0];
}
else if($user_type[0]=='S')
{    
    $email_array = mysqli_fetch_row(mysqli_query($conn, "SELECT s_email from seller where login_id= '$login_id'"));
    $email = $email_array[0];
}

$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->IsSMTP();

$mail->SMTPDebug = 1;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->IsHTML(true);
$mail->Username = "msprojects7@gmail.com";
$mail->Password = "clmsem77";
$mail->SetFrom("msprojects7@gmail.com");
$mail->Subject = "Smartphone Shop Account Activation";
$mail->Body = 'Your e-mail verification code is '.$code. '. '
        . '<a href = "http://localhost/SmartphoneShop/verifyemailcode.php?login_id='.$login_id.'">Click here'
        . '</a> to verify your email id and activate your account.';
$mail->AddAddress("$email");

$mail->send();

if($user_type[0]=='C')
    header("location: loginsession.php");

if($user_type[0]=='S')
    header("location: sellerloginsession.php");

mysqli_close($conn);