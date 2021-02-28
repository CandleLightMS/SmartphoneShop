<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$email = $_POST['email'];

include 'C:\wamp64\www\PHPMailer.php';
include 'C:\wamp64\www\SMTP.php';
include 'C:\wamp64\www\Exception.php';
include 'C:\wamp64\www\OAuth.php';
include 'C:\wamp64\www\POP3.php';

$code = rand(100000, 999999);

$emailExists = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM shipper_verification_codes WHERE email = '$email'"));

echo $emailExists;

if($emailExists==0)
{
    mysqli_query($conn, "INSERT INTO shipper_verification_codes (email, code) VALUES ('$email', $code)");
}
else
{
    mysqli_query($conn, "UPDATE shipper_verification_codes SET code=$code WHERE email = '$email'");
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
$mail->Subject = "Smartphone Shop: Shipper Confirmation Code";
$mail->Body = 'Your e-mail verification code is '.$code.'.';
$mail->AddAddress("$email");

if($mail->send())
{
    echo '<script language="javascript">';
    echo 'alert("Verification code has been sent to your e-mail id.")';
    echo '</script>';
}

header("refresh: 0; url=shippersloginsession.php");
                
mysqli_close($conn);

?>