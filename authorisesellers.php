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
        <div class="container-fluid">    
            <div class="row">
                
                <div class="col-md-10"></div>                
                <div class="col-md-2">
                <form action='adminloginsession.php'>
                    <div class="btn-group" style="padding-top: 10%; margin-left: 40%">
                        <button type="submit" class="btn btn-primary btn-block" 
                                style="background-color: lightgray; color: black">Back</button>
                    </div>
                </form>
                </div>
                
            </div>
        </div>
   </body>
   
</html>

<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$all_requests = mysqli_fetch_all(mysqli_query($conn, "SELECT * from authorisation_requests"));

if($all_requests==NULL)
    echo '<h3 style="padding-left: 5%; color: darkblue; font-family: serif">'
    . 'There are no new authorisation requests.</h3>';

$counter=0;

foreach ($all_requests as $request)
{
    $request_array_to_String=implode($request);
    
    $user = mysqli_fetch_row(mysqli_query($conn, "SELECT * from seller where login_id= '$request_array_to_String'"));
    
    $count=0;
    
    echo '<div class="container-fluid">';
    echo '<div class="row">';    
    echo '<div class="col-md-3">';    
    echo '<div class="container-fluid" style="margin-top: 20px">';  
    
    $counter++;
    
    $log_user='';
    
    foreach ($user as $user_detail)
    {
        print ("<b>");
        
            switch ($count)
            {           
                case 0:
                print ("Name: ");
                break;
            
                case 1:
                print ("Address: ");
                break;
            
                case 2:
                print ("Pincode: ");
                break;
            
                case 3:
                print ("Phone: ");
                break;
            
                case 4:
                print ("E-mail Id: ");
                break;
            
                case 5:
                print ("Login Id: ");
                    $log_user=$user_detail;
                break;            
            }
            
            print nl2br("</b>" . $user_detail . "\n");
            
            $count++;
    }
    
    echo '
        <div class="btn-group">
        <form role="form" method="post" action="authorise.php">
        <button type="submit" class="btn btn-default" name="x" value='.$log_user.'
        style="background-color: lightgray; color: black; padding-left: 20px; padding-right: 20px">
        <span class="glyphicon glyphicon-ok"></span></button>
        </form>
        </div>
    ';
    
    echo '
        <div class="btn-group">
        <form role="form" method="post" action="rejectseller.php">
        <button type="submit" class="btn btn-default" name="y" value='.$log_user.'
        style="background-color: lightgray; color: black;  padding-left: 20px; padding-right: 20px; margin-left: 10px">
        <span class="glyphicon glyphicon-remove"></span></button>
        </form>
        </div>
    ';
    
    echo '</div>';
    echo '</div>';
    
    if($counter%4==0)
    {
        echo '</div>';
        echo '</div>';
    }
}

?>