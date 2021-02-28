<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$user_id = $_SESSION['login_user'];
$product = $_GET['sp_id'];

$qty_query = mysqli_query($conn, "SELECT quantity FROM smartphone WHERE sp_id = $product");
$qty_array = mysqli_fetch_row($qty_query);
$qty = $qty_array[0];

$model_query = mysqli_query($conn, "SELECT model FROM smartphone WHERE sp_id = $product");
$model_array = mysqli_fetch_row($model_query);
$model = $model_array[0];

$brand_query = mysqli_query($conn, "SELECT brand FROM smartphone WHERE sp_id = $product");
$brand_array = mysqli_fetch_row($brand_query);
$brand = $brand_array[0];

$price_query = mysqli_query($conn, "SELECT price FROM smartphone WHERE sp_id = $product");
$price_array = mysqli_fetch_row($price_query);
$price = $price_array[0];

$box_query = mysqli_query($conn, "SELECT box_contents FROM smartphone WHERE sp_id = $product");
$box_array = mysqli_fetch_row($box_query);
$box = $box_array[0];

$photo_query = mysqli_query($conn, "SELECT photo FROM smartphone WHERE sp_id = $product");
$photo_array = mysqli_fetch_row($photo_query);
$photo = $photo_array[0];

$colour_query = mysqli_query($conn, "SELECT colour FROM smartphone WHERE sp_id = $product");
$colour_array = mysqli_fetch_row($colour_query);
$colour = $colour_array[0];

$desc_query = mysqli_query($conn, "SELECT description FROM smartphone WHERE sp_id = $product");
$desc_array = mysqli_fetch_row($desc_query);
$desc = $desc_array[0];

if(isset($_POST['submitbtn']))
{
    if(!empty($_POST['qty'] && $_POST['model'] && $_POST['brand'] && $_POST['price'] && $_POST['box_contents'] && $_POST['pic'] && $_POST['colour']
                && $_POST['desc']))
    {
        $sql = "UPDATE smartphone SET quantity = '$_POST[qty]', model = '$_POST[model]', brand = '$_POST[brand]', 
            price = '$_POST[price]', box_contents = '$_POST[box_contents]', photo = '$_POST[pic]', colour = '$_POST[colour]', 
                    description = '$_POST[desc]' WHERE sp_id = $product";
                
        if ($conn->query($sql) == TRUE) 
        {        
            echo '<script language="javascript">';
            echo 'alert("Updated successfully.")';
            echo '</script>';
        }
    }

    header("refresh:0; url=yourproducts.php");
}

mysqli_close($conn);

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Smartphone Shop</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <link href = "home.css" rel = "stylesheet"/>
        
    </head>
    
    <body>
        
        <div class="col-md-2"></div>
        
        <div class="col-md-8">
        <div class="container-fluid" style="margin-top: 5%">
        
            <form role="form" action="" style="background-color: lightyellow; border: solid black 5px" method='POST'>
            
            <h2>Specifications & Quantity of Product(s)</h2>
            <br>
                        
                <label style="font-size: 20px">Quantity:</label>
                <input type="text" class="form-control" name="qty"  value="<?php echo $qty; ?>">
            
                <label style="font-size: 20px">Model:</label>
                <input type="text" class="form-control" name="model" value="<?php echo $model; ?>">
            
                <label style="font-size: 20px">Brand:</label>
                <select class="form-control" name="brand">
                    <option><?php echo $brand; ?></option>
                    <?php if($brand!='Google')
                    echo '<option>Google</option>'; ?>
                    <?php if($brand!='Samsung')
                    echo '<option>Samsung</option>'; ?>
                    <?php if($brand!='Apple')
                    echo '<option>Apple</option>'; ?>
                    <?php if($brand!='Vivo')
                    echo '<option>Vivo</option>'; ?>
                    <?php if($brand!='Oppo')
                    echo '<option>Oppo</option>'; ?>
                    <?php if($brand!='Honor')
                    echo '<option>Honor</option>'; ?>
                    <?php if($brand!='Xiaomi')
                    echo '<option>Xiaomi</option>'; ?>
                    <?php if($brand!='Huawei')
                    echo '<option>Huawei</option>'; ?>
                    <?php if($brand!='Other')
                    echo '<option>Other</option>'; ?>
                </select>

                <label style="font-size: 20px">Price:</label>
                <input type="text" class="form-control" name="price" value="<?php echo $price; ?>">

                <label style="font-size: 20px">Box Contents:</label>
                <input type="text" class="form-control" name="box_contents" value="<?php echo $box; ?>">

                <label style="font-size: 20px">Photo:</label>
                <input type="text" class="form-control" name="pic" value="<?php echo $photo; ?>">

                <label style="font-size: 20px">Colour:</label>
                <input type="text" class="form-control" name="colour" value="<?php echo $colour; ?>">

                <label style="font-size: 20px">Description:</label>
                <input type="text" class="form-control" name="desc" value="<?php echo $desc; ?>">
                
                <br>

                <button type="submit" class="btn btn-group btn-block" name ="submitbtn" 
                    style="background-color: lightgray">Update</button>
    
            </form>
    
        </div>
        </div>
        
        <div class="col-md-2"></div>
        
    </body>
    
</html>