<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$sql = "";

if(isset($_POST['one']))
{
    $sql = "SELECT * FROM smartphone WHERE price <= 10000";
}

if(isset($_POST['two']))
{
    if($sql == "")
    {
        $sql = "SELECT * FROM smartphone WHERE price >= 10000 AND price <= 15000";
    }
    else
    {
        $sql .= " OR (price >= 10000 AND price <= 15000)";
    }
}

if(isset($_POST['three']))
{
    if($sql == "")
    {
        $sql = "SELECT * FROM smartphone WHERE price >= 15000 AND price <= 30000";
    }
    else
    {
        $sql .= " OR (price >= 15000 AND price <= 30000)";
    }
}

if(isset($_POST['four']))
{
    if($sql == "")
    {
        $sql = "SELECT * FROM smartphone WHERE price >= 30000 AND price <= 50000";
    }
    else
    {
        $sql .= " OR (price >= 30000 AND price <= 50000)";
    }
}

if(isset($_POST['five']))
{
    if($sql == "")
    {
        $sql = "SELECT * FROM smartphone WHERE price >= 50000";
    }
    else
    {
        $sql .= " OR (price >= 50000)";
    }
}

if(isset($_POST['android']) && !isset($_POST['ios']))
{
    if(isset($_POST['one']) || isset($_POST['two']) || isset($_POST['three']) || isset($_POST['four']) 
        || isset($_POST['five']))
    {
        $sql .= " AND NOT brand='Apple'";
    }
    else
    {
        $sql = "SELECT * FROM smartphone WHERE NOT brand='Apple'";
    }
}

if(!isset($_POST['android']) && isset($_POST['ios']))
{
    if(isset($_POST['one']) || isset($_POST['two']) || isset($_POST['three']) || isset($_POST['four']) 
        || isset($_POST['five']))
    {
        $sql .= " AND brand='Apple'";
    }
    else
    {
        $sql = "SELECT * FROM smartphone WHERE brand='Apple'";
    }
}

if(!isset($_POST['one']) && !isset($_POST['two']) && !isset($_POST['three']) 
        && !isset($_POST['four']) && !isset($_POST['five']) && !isset($_POST['android']) && !isset($_POST['ios']))
{
    $sql = "SELECT * FROM smartphone WHERE 1";
}

if(isset($_POST['video1']) || isset($_POST['cam0']))
{    
    $sr_query = mysqli_query($conn, "SELECT sp_id FROM review_ratings WHERE camera < 4");
    
    if(mysqli_num_rows($sr_query)>0)
    {
        while($sr_array = mysqli_fetch_row($sr_query))
        {
            $sql .= " AND NOT sp_id=$sr_array[0]";
        }
    }
}

if(isset($_POST['pics1']))
{    
    $sr_query = mysqli_query($conn, "SELECT sp_id FROM review_ratings WHERE camera < 3");
    
    if(mysqli_num_rows($sr_query)>0)
    {
        while($sr_array = mysqli_fetch_row($sr_query))
        {
            $sql .= " AND NOT sp_id=$sr_array[0]";
        }
    }
}

if(isset($_POST['battery1']))
{    
    $sr_query = mysqli_query($conn, "SELECT sp_id FROM review_ratings WHERE battery < 3");
    
    if(mysqli_num_rows($sr_query)>0)
    {
        while($sr_array = mysqli_fetch_row($sr_query))
        {
            $sql .= " AND NOT sp_id=$sr_array[0]";
        }
    }
}

if(isset($_POST['gaming1']))
{    
    $sr_query = mysqli_query($conn, "SELECT sp_id FROM review_ratings WHERE gaming < 4 OR battery < 3");
    
    if(mysqli_num_rows($sr_query)>0)
    {
        while($sr_array = mysqli_fetch_row($sr_query))
        {
            $sql .= " AND NOT sp_id=$sr_array[0]";
        }
    }
}

if(isset($_POST['ram1']))
{    
    $sr_query = mysqli_query($conn, "SELECT sp_id FROM review_ratings WHERE ram < 3 AND gen_performance <3");
    
    if(mysqli_num_rows($sr_query)>0)
    {
        while($sr_array = mysqli_fetch_row($sr_query))
        {
            $sql .= " AND NOT sp_id=$sr_array[0]";
        }
    }
}

if(isset($_POST['istorage2']))
{    
    $sr_query = mysqli_query($conn, "SELECT sp_id FROM review_ratings WHERE int_storage < 2");
    
    if(mysqli_num_rows($sr_query)>0)
    {
        while($sr_array = mysqli_fetch_row($sr_query))
        {
            $sql .= " AND NOT sp_id=$sr_array[0]";
        }
    }
}

if(isset($_POST['istorage3']))
{    
    $sr_query = mysqli_query($conn, "SELECT sp_id FROM review_ratings WHERE int_storage < 3");
    
    if(mysqli_num_rows($sr_query)>0)
    {
        while($sr_array = mysqli_fetch_row($sr_query))
        {
            $sql .= " AND NOT sp_id=$sr_array[0]";
        }
    }
}

if(isset($_POST['istorage4']))
{    
    $sr_query = mysqli_query($conn, "SELECT sp_id FROM review_ratings WHERE int_storage < 4");
    
    if(mysqli_num_rows($sr_query)>0)
    {
        while($sr_array = mysqli_fetch_row($sr_query))
        {
            $sql .= " AND NOT sp_id=$sr_array[0]";
        }
    }
}

if(isset($_POST['istorage5']))
{    
    $sr_query = mysqli_query($conn, "SELECT sp_id FROM review_ratings WHERE int_storage < 5");
    
    if(mysqli_num_rows($sr_query)>0)
    {
        while($sr_array = mysqli_fetch_row($sr_query))
        {
            $sql .= " AND NOT sp_id=$sr_array[0]";
        }
    }
}

if(isset($_POST['m_fastcharging']))
{    
    $sr_query = mysqli_query($conn, "SELECT sp_id FROM review_ratings WHERE fast_charging < 0.5");
    
    if(mysqli_num_rows($sr_query)>0)
    {
        while($sr_array = mysqli_fetch_row($sr_query))
        {
            $sql .= " AND NOT sp_id=$sr_array[0]";
        }
    }
}

if(isset($_POST['m_faceunlock']))
{    
    $sr_query = mysqli_query($conn, "SELECT sp_id FROM review_ratings WHERE face_unlock < 0.5");
    
    if(mysqli_num_rows($sr_query)>0)
    {
        while($sr_array = mysqli_fetch_row($sr_query))
        {
            $sql .= " AND NOT sp_id=$sr_array[0]";
        }
    }
}

if(isset($_POST['m_glassback']) && !isset($_POST['mnh_glassback']))
{    
    $sr_query = mysqli_query($conn, "SELECT sp_id FROM review_ratings WHERE glass_back < 0.5");
    
    if(mysqli_num_rows($sr_query)>0)
    {
        while($sr_array = mysqli_fetch_row($sr_query))
        {
            $sql .= " AND NOT sp_id=$sr_array[0]";
        }
    }
}

if(isset($_POST['m_notch']) && !isset($_POST['mnh_notch']))
{    
    $sr_query = mysqli_query($conn, "SELECT sp_id FROM review_ratings WHERE notch < 0.5");
    
    if(mysqli_num_rows($sr_query)>0)
    {
        while($sr_array = mysqli_fetch_row($sr_query))
        {
            $sql .= " AND NOT sp_id=$sr_array[0]";
        }
    }
}

if(isset($_POST['m_speaker']))
{    
    $sr_query = mysqli_query($conn, "SELECT sp_id FROM review_ratings WHERE loud_speaker < 0.5");
    
    if(mysqli_num_rows($sr_query)>0)
    {
        while($sr_array = mysqli_fetch_row($sr_query))
        {
            $sql .= " AND NOT sp_id=$sr_array[0]";
        }
    }
}

if(isset($_POST['m_stockandroid']) && !isset($_POST['mnh_stockandroid']))
{    
    $sr_query = mysqli_query($conn, "SELECT sp_id FROM review_ratings WHERE stock_android < 0.5");
    
    if(mysqli_num_rows($sr_query)>0)
    {
        while($sr_array = mysqli_fetch_row($sr_query))
        {
            $sql .= " AND NOT sp_id=$sr_array[0]";
        }
    }
}

if(isset($_POST['m_expandablestorage']))
{    
    $sr_query = mysqli_query($conn, "SELECT sp_id FROM review_ratings WHERE exp_storage < 0.5");
    
    if(mysqli_num_rows($sr_query)>0)
    {
        while($sr_array = mysqli_fetch_row($sr_query))
        {
            $sql .= " AND NOT sp_id=$sr_array[0]";
        }
    }
}

if(isset($_POST['mnh_glassback']) && !isset($_POST['m_glassback']))
{    
    $sr_query = mysqli_query($conn, "SELECT sp_id FROM review_ratings WHERE glass_back > 0.25");
    
    if(mysqli_num_rows($sr_query)>0)
    {
        while($sr_array = mysqli_fetch_row($sr_query))
        {
            $sql .= " AND NOT sp_id=$sr_array[0]";
        }
    }
}

if(isset($_POST['mnh_notch']) && !isset($_POST['m_notch']))
{    
    $sr_query = mysqli_query($conn, "SELECT sp_id FROM review_ratings WHERE notch > 0.25");
    
    if(mysqli_num_rows($sr_query)>0)
    {
        while($sr_array = mysqli_fetch_row($sr_query))
        {
            $sql .= " AND NOT sp_id=$sr_array[0]";
        }
    }
}

if(isset($_POST['mnh_stockandroid']) && !isset($_POST['m_stockandroid']))
{    
    $sr_query = mysqli_query($conn, "SELECT sp_id FROM review_ratings WHERE stock_android > 0.25");
    
    if(mysqli_num_rows($sr_query)>0)
    {
        while($sr_array = mysqli_fetch_row($sr_query))
        {
            $sql .= " AND NOT sp_id=$sr_array[0]";
        }
    }
}

$sql_query =  mysqli_query($conn, $sql);

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

$counter=0;

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
            .'<form class="form-inline" method="post" action="addtocart_filter.php?sp_id='.$row[0].'" style="margin-left: 50%">'            
            . '<button type="submit" class="btn btn-info"
                style="background-color: lightgray; color: black; border-color: black">'
                . '<span class="glyphicon glyphicon-plus"></span>'
                     .' Add to Cart'
                    . '</button>'
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