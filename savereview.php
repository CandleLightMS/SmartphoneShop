<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$sp_id = $_GET['sp_id'];
$order_id = $_GET['order_id'];

$flag=0;

$r_id = 1;

    try
    {
        if(!empty($_POST['genp'] && $_POST['cam'] && $_POST['battery'] && $_POST['gaming'] && $_POST['ram'] 
                && $_POST['istorage']))
        {
            isset($_POST['fastcharging'])? $fc = 1 : $fc = 0;
            isset($_POST['faceunlock'])? $fu = 1 : $fu = 0;
            isset($_POST['glassback'])? $gb = 1 : $gb = 0;
            isset($_POST['notch'])? $n = 1 : $n = 0;
            isset($_POST['speaker'])? $s = 1 : $s = 0;
            isset($_POST['stockandroid'])? $sa = 1 : $sa = 0;
            isset($_POST['expandablestorage'])? $es = 1 : $es = 0;
            isset($_POST['fastcharging'])? $fc = 1 : $fc = 0;            
            
            $maxrowobj = mysqli_query($conn, "SELECT MAX(r_id) as max FROM reviews");            
            $maxrow = mysqli_fetch_array($maxrowobj);            
            $r_id = $maxrow['max'];
            
            $r_id++;
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
            
                $sql = "INSERT INTO reviews (r_id, sp_id, gen_performance, camera, battery, gaming, ram, int_storage,
                    fast_charging, face_unlock, glass_back, notch, loud_speaker, stock_android, exp_storage) VALUES 
                ($r_id, $sp_id, $_POST[genp], $_POST[cam], $_POST[battery], $_POST[gaming], $_POST[ram], 
                $_POST[istorage], $fc, $fu, $gb, $n, $s, $sa, $es)";
                
                if ($conn->query($sql) == TRUE) 
                {
                    mysqli_query($conn, "UPDATE orders SET hasBeenReviewed = TRUE WHERE order_id = $order_id");
                }            
            }
        }
        catch (Exception $ex){}
    }

    header("location: review_ratings.php?r_id=$r_id");

$conn->close();