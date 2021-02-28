<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$shipper_query = mysqli_query($conn, "SELECT * FROM shipper");

echo ''
.   '<div class="container-fluid">
    <div class="row" style="padding-left: 5%; padding-top: 4%">
    <div class="btn-group">
        <a href="shippersloginsession.php">
        <button type="button" class="btn btn-primary">Home</button>
        </a>
    </div>
    </div>
    </div>';

$counter = 0;

while($shipper_array = mysqli_fetch_row($shipper_query))
{
    $counter++;
    
    $count=0;
    
    echo '<div class="container-fluid">';
    echo '<div class="row">';    
    echo '<div class="col-md-4" style="margin-top: 4%; padding-left: 5%; padding-right: 5%; color: black">';        
        
    foreach ($shipper_array as $user_detail)
    {
        print ("<b>");
    
        $isShipperBanned = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM banned_shippers WHERE email = '$shipper_array[4]'"));
        
        if($isShipperBanned>0) echo '<div style="color: gray">';
        
        switch ($count)
        {           
            case 1:
                print ("Name: ");
                break;
            
            case 2:
                print ("Address: ");
                break;
                        
            case 3:
                print ("Phone: ");
                break;
            
            case 4:
                print ("E-mail Id: ");
                break;
        }
            
        if($count!=0)
            print nl2br("</b>" . $user_detail);
        else
            print nl2br("</b>");
        
        if($isShipperBanned>0)
            echo '</div>';
        
        if($count!=0 && $count!=1 && $isShipperBanned==0)
            print nl2br ("\n");
        
        if($count==1)
        {           
            if(!($isShipperBanned>0))
            {
                echo ''    
                . '<form class="form-inline" method="post" action="update_shipper.php?email='.$shipper_array[4].'" '
                        . 'style="margin-left: 50%">'            
                . '<button type="submit" class="btn btn-default"
                style="background-color: white; color: black; border-color: black; 
                font-size: 12px; margin-left: 40%; font-family: sans-serif">'
                . 'Update <span class="glyphicon glyphicon-edit"></span>'
                .'</button>'
                . '</form>';
            }
            else
            {
                echo ''    
                . '<form class="form-inline" method="post" action="remove_ban_shipper.php?email='.$shipper_array[4].'&&head=u" '
                        . 'style="margin-left: 50%">'            
                . '<button type="submit" class="btn btn-default"
                style="background-color: gray; color: black; border-color: black; 
                font-size: 12px; margin-left: 40%; font-family: sans-serif">'
                . 'Remove Ban <span class="glyphicon glyphicon-ban-circle"></span>'
                .'</button>'
                . '</form>';
            }
        }
            
        $count++;
    }    
        
    echo '</div>';
    
    if($counter%3==0)
    {
        echo '</div>';
        echo '</div>';
            
    }
};

?>
<html>
   
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            body
            {
                background-color: lightyellow;
            }
        </style>
   </head>
   
   <body>        
   </body>
   
</html>