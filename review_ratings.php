<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$r_id = $_GET['r_id'];

$query = mysqli_query($conn, "SELECT * FROM reviews WHERE r_id = $r_id");

$r = mysqli_fetch_row($query);

$sp_id = $r[1];
    
$sp_id_exists = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM review_ratings WHERE sp_id = $sp_id"));
    
if($sp_id_exists==1)
{    
    $rating_query = mysqli_query($conn, "SELECT * FROM review_ratings WHERE sp_id = $sp_id");
    $rating = mysqli_fetch_row($rating_query);
    
    $gen_performance = ($r[2] + $rating[1])/2;
    $camera = ($r[3] + $rating[2])/2;
    $battery = ($r[4] + $rating[3])/2;
    $gaming = ($r[5] + $rating[4])/2;
    $ram = ($r[6] + $rating[5])/2;
    $int_storage = ($r[7] + $rating[6])/2;
    $fast_charging = ($r[8] + $rating[7])/2;
    $face_unlock = ($r[9] + $rating[8])/2;
    $glass_back = ($r[10] + $rating[9])/2;
    $notch = ($r[11] + $rating[10])/2;
    $loud_speaker = ($r[12] + $rating[11])/2;
    $stock_android = ($r[13] + $rating[12])/2;
    $exp_storage = ($r[14] + $rating[13])/2;
        
    $sql = "UPDATE review_ratings SET gen_performance=$gen_performance, camera=$camera, battery=$battery, 
        gaming=$gaming, ram=$ram, int_storage=$int_storage, fast_charging=$fast_charging, face_unlock=$face_unlock, 
            glass_back=$glass_back, notch=$notch, loud_speaker=$loud_speaker, stock_android=$stock_android, 
                exp_storage=$exp_storage WHERE sp_id=$sp_id";
    
    mysqli_query($conn, $sql);
}
else
{
    $sql = "INSERT INTO review_ratings (sp_id, gen_performance, camera, battery, gaming, ram, int_storage,
        fast_charging, face_unlock, glass_back, notch, loud_speaker, stock_android, exp_storage) VALUES 
        ($sp_id, $r[2], $r[3], $r[4], $r[5], $r[6], $r[7], $r[8], $r[9], $r[10], $r[11], $r[12], $r[13], $r[14])";
    
    mysqli_query($conn, $sql);
}

header("location: myorders.php");