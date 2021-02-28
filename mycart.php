<?php 

session_start();

include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$my_cart_items = mysqli_query($conn, "SELECT * FROM cart WHERE customer_login_id = '$_SESSION[login_user]'");

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

$flag=0;

$counter = 0;

while($item = mysqli_fetch_row($my_cart_items))
{
    $counter++;
    
    $flag=1;
    
    $item_detail = mysqli_fetch_row(mysqli_query($conn, "SELECT * FROM smartphone WHERE sp_id = $item[1]"));
    
    $gst = $item[4];
    
    $item_total = $item[5];

    $count=0;
    
    echo '<div class="container-fluid">';
    echo '<div class="row">';    
    echo '<div class="col-md-4" style="margin-top: 5%; padding-left: 5%; padding-right: 5%">';        
    
    print nl2br("<img src=$item_detail[6] height='350px' width='300px' />\n");    
    
    print nl2br("<h4>Specifications:</h4>");
    
    foreach ($item_detail as $value)
    {
        $count++;
        
        if($count==1 || $count==2 || $count==5 || $count==7 || $count==10)
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
            print nl2br("\n\n<b>Price: " . $item_detail[4] . "</b>");
            print nl2br("\n\n<b>GST: " . $gst . "</b>");
            print nl2br("\n\n<b>Total Price: " . $item_total . "</b>\n\n");
            
            echo ''    
            . '<form class="form-inline" method="post" action="PayUMoney_form.php?cart_item_id='.$item[0].'">'                
            . '<button type="submit" class="btn btn-block"
                style="background-color: lightyellow; color: darkblue; border-color: darkblue">'
                     .' Buy Now'
                    . '</button>               '
            . '</form>';
            
            echo ''    
          . '<form class="form-inline" method="post" action="removefromcart.php?cart_item_id='.$item[0].'">'
            . '<button type="submit" class="btn btn-block"
                style="background-color: white; color: black; border-color: darkgray">'
                     .' Remove'
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
};

if($flag==0)
{
    echo '<h3 style="margin-left: 5%; margin-top: 5%; color: black; font-family: serif">'
    . 'Your cart is empty.</h3>';    
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
                background-color: lightgray;
                color: black;
            }
        </style>
   </head>
   
   <body>
   </body>
   
</html>