<?php

include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$login_id = $_GET['login_id'];
$code2 = $_GET['code'];

echo $login_id;
echo $code2;

$code_query = mysqli_query($conn, "SELECT code FROM changepassword_codes WHERE login_id = '$login_id'");
$code_array = mysqli_fetch_row($code_query);
$code = $code_array[0];

if($code2 == $code)
{    
    header("location: forgotchangepassword.php?login_id=$login_id");
}

mysqli_close($conn);