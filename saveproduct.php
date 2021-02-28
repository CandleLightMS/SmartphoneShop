<?php

session_start();

include 'config.php';

mysqli_select_db($conn, 'smartphone_shop');

$flag=0;

    try
    {
        if(!empty($_POST['qty'] && $_POST['model'] && $_POST['brand'] && $_POST['price'] && $_POST['box_contents'] && $_POST['pic'] && $_POST['colour']
                && $_POST['desc']))
        {
            
            $maxrowobj = mysqli_query($conn, "SELECT MAX(sp_id) as max FROM smartphone");            
            $maxrow = mysqli_fetch_array($maxrowobj);            
            $sp_id = $maxrow['max'];
            
            $sp_id++;
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
            
                $sql = "INSERT INTO smartphone (sp_id, quantity, model, brand, price, box_contents, photo, colour, 
                    description, login_id) VALUES ($sp_id, '$_POST[qty]', '$_POST[model]', '$_POST[brand]', '$_POST[price]',"
                        . " '$_POST[box_contents]',"
                        . "'$_POST[pic]', '$_POST[colour]', '$_POST[desc]', '$_SESSION[login_user]')";
                
                if ($conn->query($sql) == TRUE) 
                {        
                    echo '<script language="javascript">';
                    echo 'alert("The product has been added successfully.")';
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
            echo 'alert("The product could not be added.")';
            echo '</script>';
        }
    }

    header("refresh:0; url=sellerloginsession.php");

$conn->close();