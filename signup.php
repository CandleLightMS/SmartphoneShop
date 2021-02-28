<?php

include("index.php");
include("config.php");

mysqli_select_db($conn, 'smartphone_shop');

$flag=0;

    try
    {
        if(!empty($_POST['name'] && $_POST['address'] && $_POST['pincode'] && $_POST['phone'] && $_POST['lid'] && $_POST['email'] && $_POST['spwd']))
        {
            if($_POST['spwd'] != $_POST['cspwd'])
            {
                echo '<script language="javascript">';
                echo 'alert("Passwords do not match.")';
                echo '</script>';
            
                $flag=1;
            }
    
            $email=$_POST['email'];
            $slquery = "SELECT * FROM customer WHERE u_email = '$email'";
            $selectresult = mysqli_query($conn, $slquery);
            if(mysqli_num_rows($selectresult)>0)
            {
                echo '<script language="javascript">';
                echo 'alert("This e-mail id already exists.")';
                echo '</script>';
            
                $flag=1;
            }
        
            $lid=$_POST['lid'];
            $slquery2 = "SELECT * FROM login WHERE login_id = '$lid'";
            $selectresult2 = mysqli_query($conn, $slquery2);
            if(mysqli_num_rows($selectresult2)>0)
            {
                echo '<script language="javascript">';
                echo 'alert("This id already exists.")';
                echo '</script>';
            
                $flag=1;
            }
        }
        else
        {
            $flag=1;
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
            $sql_login = "INSERT INTO login (login_id, password, user_type) VALUES ('$_POST[lid]', '$_POST[spwd]', 'C')";
        
            if($conn->query($sql_login) == TRUE)
            {
                $sql = "INSERT INTO customer (u_name, u_address, u_pincode, u_phone, login_id, u_email)"
                . " VALUES ('$_POST[name]','$_POST[address]', '$_POST[pincode]', '$_POST[phone]', '$_POST[lid]', '$_POST[email]')";                
                
                
                if ($conn->query($sql) == TRUE) 
                {
                    mysqli_query($conn, "INSERT INTO verify (login_id, status, code)"
                    . " VALUES ('$_POST[lid]', 0, 0)");
                    
                    echo '<script language="javascript">';
                    echo 'alert("Your account has been successfully created.")';
                    echo '</script>';
                }
                else
                {
                    $flag = 1;
                }
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
            echo 'alert("Account creation attempt unsucessful.")';
            echo '</script>';
        }
    }

$conn->close();