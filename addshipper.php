<?php

session_start();
include("config.php");
mysqli_select_db($conn, 'smartphone_shop');

$flag=0;

$code = $_POST['code'];
$email = $_POST['email'];

$code2_query = mysqli_query($conn, "SELECT code FROM shipper_verification_codes WHERE email = '$email'");

if(mysqli_num_rows($code2_query)==0)
{
    $flag=1;
}
else
{
    $code2_array = mysqli_fetch_row($code2_query);
    $code2 = $code2_array[0];
}

if($flag==0 && $code==$code2)
{
    try
    {
        if(!empty($_POST['name'] && $_POST['code'] && $_POST['address'] && $_POST['phone'] && $_POST['email']))
        {
            $email=$_POST['email'];
            $slquery = "SELECT * FROM shipper WHERE sh_email = '$email'";
            $selectresult = mysqli_query($conn, $slquery);
            if(mysqli_num_rows($selectresult)>0)
            {
                echo '<script language="javascript">';
                echo 'alert("This e-mail id already exists.")';
                echo '</script>';
            
                $flag=1;
            }
        }
    }
    catch(Exception $e)
    {        
        echo $e;
    }
        
    finally
    {
        try
        {         
            if($flag==0)
            {
                $sh_id = 1;
                
                $maxrowobj = mysqli_query($conn, "SELECT MAX(sh_id) as max FROM shipper");            
                $maxrow = mysqli_fetch_array($maxrowobj);            
                $sh_id = $maxrow['max'];
            
                $sh_id++;
                
                $sql = "INSERT INTO shipper (sh_id, sh_name, sh_address, sh_phone, sh_email)"
                . " VALUES ($sh_id, '$_POST[name]','$_POST[address]', '$_POST[phone]', '$_POST[email]')";                
                
                
                if ($conn->query($sql) == TRUE) 
                {
                    echo '<script language="javascript">';
                    echo 'alert("The shipper has been added successfully.")';
                    echo '</script>';
                }
                else
                {
                    $flag = 1;
                }
            }
        }
        catch (Exception $ex)
        {
            echo $ex;
        }
        
        if($flag==1)
        {
            echo '<script language="javascript">';
            echo 'alert("Shipper addition attempt unsucessful.")';
            echo '</script>';
        }
    
        header("refresh: 0; url=shippersloginsession.php");
    }
}
else
{
    echo '<script language="javascript">'
    . 'alert("Verification code is incorrect. Try again.");'
    . '</script>';
    
    header("refresh: 0; url=shippersloginsession.php");
}

$conn->close();