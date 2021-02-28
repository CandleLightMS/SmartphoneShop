<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$query="SELECT * FROM best_offers";
$sql_query =  mysqli_query($conn, $query);

while($result = mysqli_fetch_row($sql_query))
{
    $next_query = mysqli_query($conn, "SELECT * FROM smartphone WHERE sp_id = $result[0]");

    $counter = 0;

    while ($row = mysqli_fetch_row($next_query))
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
        
            if($count==1 || $count==2 || $count==7 || $count==10)
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
            
                if($count!=9)
                    print nl2br("</b>" . $value . "\n");
                else
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
            }
        
            echo ''
            . '<script type="text/javascript">
            function showText(e)
            {
                $(e).html($(e).find(".hide-text").html());
            }
            </script>';        
        
            if($count==9)
            {
                echo ''    
                . '<form class="form-inline" method="post" action="addtocart.php?sp_id='.$row[0].'" style="margin-left: 50%">'            
                . '<button type="submit" class="btn btn-info"
                style="background-color: white; color: black; border-color: black">'
                . '<span class="glyphicon glyphicon-plus"></span>'
                     .' Add to Cart'
                    . '</button>               '
                . '</form>';
            }
        }
        
        echo '</div>';
        if($counter%3==0)
        {
            echo '</div>';
            echo '</div>';
        }    
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
                background-color: lightcyan;
            }
        </style>
   </head>
   
   <body>        
   </body>
   
</html>