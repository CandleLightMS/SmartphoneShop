<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$user_id = $_SESSION['login_user'];

$name_query = mysqli_query($conn, "SELECT u_name FROM customer WHERE login_id = '$user_id'");
$name_array = mysqli_fetch_row($name_query);
$name = $name_array[0];

if(isset($_POST['submitbtn']))
{
    if(!empty($_POST['delete']))
    {
        $delete = $_POST['delete'];
        
        if($delete=='Yes')
        {
            $user_type_query = mysqli_query($conn, "SELECT user_type FROM login WHERE login_id = '$user_id'");
            $user_type_array = mysqli_fetch_row($user_type_query);
            $user_type = $user_type_array[0];
            
            switch($user_type)
            {
                case 'C':
                    
                if(mysqli_num_rows(mysqli_query($conn, "SELECT sp_id FROM cart where customer_login_id = '$user_id'"))>0)
                {   
                    //remove all from this C's cart
                    while($products_array = mysqli_fetch_row(mysqli_query($conn, "SELECT sp_id FROM cart where customer_login_id = '$user_id'")))
                    {
                        $product = $products_array[0];
                                                
                        $cart_item_id_array = mysqli_fetch_row(mysqli_query($conn, "SELECT cart_item_id FROM cart where "
                                . "customer_login_id = '$user_id' and sp_id = $product"));
                        $cart_item_id = $cart_item_id_array[0];
                        
                        mysqli_query($conn, "DELETE FROM cart WHERE cart_item_id = $cart_item_id");
                        
                        $quantity_array = mysqli_fetch_row(mysqli_query($conn, "SELECT quantity FROM smartphone where sp_id = $product"));
                        $quantity = $quantity_array[0];
                        
                        $quantity = $quantity + 1;
                        
                        mysqli_query($conn, "UPDATE smartphone SET quantity = $quantity WHERE sp_id = $product");
                    }
                }                    
                    
                mysqli_query($conn, "INSERT INTO deleted_accounts (login_id) VALUES ('$user_id')"); 
                echo '<script language="javascript">
                    alert("Your account has been deleted successfully.");
                    </script>';
                
                header("refresh: 0; url=index.php");
                break;
                
                case 'S':
                
                if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM orders where seller_login_id = '$user_id' AND isPacked = FALSE"))>0) 
                {
                    echo '<script language="javascript">
                    alert("Your account cannot be deleted unless you pack all the products '
                    .'whose orders you have received. Pack the products then try again.");
                    </script>';
                    
                    header("refresh: 0; url=deleteaccount.php");
                    break;
                }
                else
                {
                    //update all smartphones addded by S -> OUT OF STOCK
                    mysqli_query($conn, "UPDATE smartphone SET quantity = 0 WHERE login_id = '$user_id'");
                    
                    mysqli_query($conn, "INSERT INTO deleted_accounts (login_id) VALUES ('$user_id')"); 
                    
                    echo '<script language="javascript">
                    alert("Your account has been deleted successfully.");
                    </script>';
                    
                    header("refresh: 0; url=index.php");
                    break;
                }
            }
        }
        else
        {
            echo '<script language="javascript">
            history.go(-2);
            </script>';
        }
    }    
}

mysqli_close($conn);

?>

<html>
   
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href = "home.css" rel = "stylesheet"/>        
    </head>
   
    <body>       
    
    <div class="container-fluid">    
    <div class="row">                
        
        <div class="col-md-2" style="margin-top: 5%; margin-left: 5%">
        <div class="container-fluid">
            <form role="form" method="post" action="loginsession.php">
            <button type="submit" class="btn btn-primary">
            Home</button>
            </form>
        </div>
        </div>        
        
        <div class="col-md-1"></div>
        
        <div class="col-md-4" style="margin-top: 15%; margin-left: 5%; background-color: lightyellow; border: solid 5px lightgray">
            
            <form role="form" method="post" action="">
            
            <h3>Are you sure you want to delete your account?</h3>
            <h4>This action is permanent and cannot be undone.</h4>
            
            <select class="form-control" name="delete">
                <option>No</option>
                <option>Yes</option>
            </select>
            
            <br>
            
            <button type="submit" class="btn btn-group" name ="submitbtn" style="border-color: lightgray">Ok</button>
            </form>
            
        </div>
        
    </div>        
    </div>

   </body>
   
</html>