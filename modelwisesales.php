<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$query = mysqli_query($conn, "SELECT * FROM orders");

echo ''
.   '<div class="container-fluid">
    <div class="row" style="padding-left: 5%; padding-top: 4%">
    <div class="btn-group">
        <a href="loginsession.php">
        <button type="button" class="btn btn-primary">Home</button>
        </a>
    </div>
    </div>
    </div>';

if(mysqli_num_rows($query)>0)
{
    $counter=0;
    
    while($order = mysqli_fetch_row($query))
    {
        $flag=0;
        $countm=0;
        
        $sp_id = $order[1];
                
        $repeat_query = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM orders WHERE sp_id = $sp_id"));
        
        if($repeat_query > 1)
        {
            $minrowobj = mysqli_query($conn, "SELECT MIN(order_id) as min FROM orders WHERE sp_id = $sp_id");            
            $minrow = mysqli_fetch_array($minrowobj);
            $min_order_id = $minrow['min'];
            
            $this_order_id = $order[0];
            
            if($this_order_id != $min_order_id)
                continue;
        }
                
        $model_array = mysqli_fetch_row(mysqli_query($conn, "SELECT model FROM smartphone WHERE sp_id = $sp_id"));
        $model = $model_array[0];
        
        $model_products_query = mysqli_query($conn, "SELECT sp_id FROM smartphone WHERE model = '$model'");
        
        $add_quantity = 0;
        
        while($model_products_array = mysqli_fetch_row($model_products_query))
        {
            $model_sp_id = $model_products_array[0];
            $countm++;
                        
            if($sp_id != $model_sp_id)
            {
                $model_order_id_query = mysqli_query($conn, "SELECT order_id FROM orders WHERE sp_id = $model_sp_id");
                $add_quantity += mysqli_num_rows($model_order_id_query);
                
                $flag=1;
                break;
            }
        }
        
        if($flag == 1 && $countm > 1)
        {
            continue;
        }
                
        $sql_query = mysqli_query($conn, "SELECT * FROM smartphone WHERE sp_id = $sp_id");

        while ($row = mysqli_fetch_row($sql_query))
        {
            $count=0;
    
            echo '<div class="container-fluid">';
            echo '<div class="row">';    
            echo '<div class="col-md-4" style="margin-top: 5%; padding-left: 5%; padding-right: 5%">';        
    
            $counter++;
    
            if($row[1]==0)
            {
                print nl2br('<h3 style="color: red">OUT OF STOCK</h3>');
            }
    
            print nl2br("<img src=$row[6] height='350px' width='300px' />\n");    
    
            print nl2br("<h4>Specifications:</h4>");
    
            foreach ($row as $value)
            {
                $count++;
        
                if($count==1 || $count==2 || $count==7)
                    continue;
        
                else
                {
                    print ("<b>");
            
                    switch ($count)
                    {           
                        case 3:
                            print ("Model: ");
                            break;
            
                        case 4:
                            print ("Brand: ");
                            break;
            
                        case 5:
                            print ("Price: ");
                            break;
            
                        case 6:
                            print ("Box Contents: ");
                            break;
            
                        case 8:
                            print ("Colour: ");
                            break;
            
                        case 9:
                            print ("Description: ");
                            break;
                    }
            
                    if($count!=9 & $count!=10)
                    {
                        print nl2br("</b>" . $value . "\n");
                    }
                    else if($count==9)
                    {
                        print nl2br("</b>");
                
                        $str = $value;                
                        $limit = 250;
                
                        if(strlen($str)>$limit)
                        {
                            $stringCut = substr($str, 0, $limit);
                            $serRpos = strrpos($stringCut, ' ');
                            $first_part = substr(substr($str, 0, $limit), 0,$serRpos);
                            $last_part = substr($str,$serRpos);
            
                            echo $first_part;
                            echo '<span style="cursor: pointer" onclick="showText(this)"> '
                            . '...<span class="hide-text" style="display: none;">'.$last_part.'</span></span>';
                        }
                        else
                        {
                            echo $str;
                        }
                    }                    
                    else if($count == 10)
                    {
                        print nl2br("\n</b>");
                        
                        $quantity_sold = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM orders WHERE sp_id = $sp_id"))
                                + $add_quantity;
                        
                        print nl2br("\n<h4>Quantity sold: </h4>" . $quantity_sold);
                    }
                }
        
                echo ''
                . '<script type="text/javascript">
                    function showText(e)
                    {
                        $(e).html($(e).find(".hide-text").html());
                    }
                    </script>';        
            }
        
            echo '</div>';
            if($counter%3==0)
            {
                echo '</div>';
                echo '</div>';
            }
        }
    }
}

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
                background-color: lightblue;
                color: black;
            }
        </style>        
   </head>
   
   <body>
   </body>
   
</html>