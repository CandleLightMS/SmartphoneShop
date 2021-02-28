<?php

session_start();
include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

$order_id = $_GET['order_id'];

$sp_id_array = mysqli_fetch_row(mysqli_query($conn, "SELECT sp_id FROM orders WHERE order_id = $order_id"));
$sp_id = $sp_id_array[0];

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
        
            <form action="savereview.php?sp_id=<?php echo $sp_id ?>&&order_id=<?php echo $order_id ?>" 
                  style="background-color: lightyellow; border: solid blue 5px;
                  padding-left: 50px; padding-right: 50px" method='POST'>
                <center>
                    <h2 style="font-family: serif">Product Review</h2>
                </center>
            
            <div class="form-inline">
                <label style="font-size: 20px; font-family: sans-serif; margin-right: 40px">General Performance: </label>
                <label class="radio-inline"><input type="radio" name="genp" value="5">Excellent</label>
                <label class="radio-inline"><input type="radio" name="genp" value="4">Good</label>
                <label class="radio-inline"><input type="radio" name="genp" value="3">Average</label>
                <label class="radio-inline"><input type="radio" name="genp" value="2">Below Average</label>
                <label class="radio-inline"><input type="radio" name="genp" value="1">Poor</label> 
            </div>
                
            <div class="form-group">
                <label style="font-size: 20px; font-family: sans-serif; margin-right: 40px">Camera Performance: </label>
                <div class="radio"><input type="radio" name="cam" value="5">Excellent (takes pictures & records videos in 4K and the videos do not shake while moving even at 1080p)</div>
                <div class="radio"><input type="radio" name="cam" value="4">Good (videos are stable, picture & video clarity is good portrait mode is good too)</div>
                <div class="radio"><input type="radio" name="cam" value="3">Average (pictures and videos are as per the expectations but there is no stabilisation in high quality (>=720p) videos)</div>
                <div class="radio"><input type="radio" name="cam" value="2">Below Average</div>
                <div class="radio"><input type="radio" name="cam" value="1">Poor</div> 
            </div>
            
            <div class="form-group">
                <label style="font-size: 20px; font-family: sans-serif; margin-right: 40px">Battery Performance: </label>
                <div class="radio"><input type="radio" name="battery" value="5">Excellent (lasts for around 2 working days with normal usage)</div>
                <div class="radio"><input type="radio" name="battery" value="4">Good (easily lasts for at least a full working day with normal to heavy usage)</div>
                <div class="radio"><input type="radio" name="battery" value="3">Average (requires one time charging to last for a full working day with normal to heavy usage)</div>
                <div class="radio"><input type="radio" name="battery" value="2">Below Average (requires two or more than two times charging to last for a full working day with normal usage)</div>
                <div class="radio"><input type="radio" name="battery" value="1">Poor (battery drains very fastly)</div> 
            </div>
                
            <div class="form-group">
                <label style="font-size: 20px; font-family: sans-serif; margin-right: 40px">Gaming Performance: </label>
                <div class="radio"><input type="radio" name="gaming" value="5">Excellent (does not heat much even with extensive gaming)</div>
                <div class="radio"><input type="radio" name="gaming" value="4">Good (gets warm with extensive gaming but the heat is never unbearable)</div>
                <div class="radio"><input type="radio" name="gaming" value="3">Average (heats up with extensive gaming but otherwise the device remains cool)</div>
                <div class="radio"><input type="radio" name="gaming" value="2">Below Average (heats even with normal gaming)</div>
                <div class="radio"><input type="radio" name="gaming" value="1">Poor (the device is not for gaming at all)</div> 
            </div>
                
            <div class="form-group">
                <label style="font-size: 20px; font-family: sans-serif; margin-right: 40px">RAM & User Experience: </label>
                <div class="radio"><input type="radio" name="ram" value="5">Excellent (apps do not reload even when more than or equal to five apps are in use simultaneously)</div>
                <div class="radio"><input type="radio" name="ram" value="4">Good (apps reload when more than or equal to five apps are in use simultaneously)</div>
                <div class="radio"><input type="radio" name="ram" value="3">Average (apps reload when more than or equal to three apps are in use simultaneously)</div>
                <div class="radio"><input type="radio" name="ram" value="2">Below Average (apps reload when more than or equal to two apps are in use simultaneously)</div>
                <div class="radio"><input type="radio" name="ram" value="1">Poor (apps reload when more than one apps are in use simultaneously)</div> 
            </div>
                
            <div class="form-group">
                <label style="font-size: 20px; font-family: sans-serif; margin-right: 40px">How much is the Internal Storage? </label>
                <div class="radio"><input type="radio" name="istorage" value="1">Less than or equal to 8 GB</div>
                <div class="radio"><input type="radio" name="istorage" value="2">Greater than or equal to 16 GB</div>
                <div class="radio"><input type="radio" name="istorage" value="3">Greater than or equal to 32 GB</div>
                <div class="radio"><input type="radio" name="istorage" value="4">Greater than or equal to 64 GB</div>
                <div class="radio"><input type="radio" name="istorage" value="5">Greater than or equal to 128 GB</div> 
            </div>
                            
            <div class="form-group">
                <label style="font-size: 20px; font-family: sans-serif; margin-right: 40px">Select the features present in this product: </label>
                <div class="checkbox"><input type="checkbox" name="fastcharging">Fast Charging</div>
                <div class="checkbox"><input type="checkbox" name="faceunlock">Face Unlock</div>
                <div class="checkbox"><input type="checkbox" name="glassback">Glass Back</div>
                <div class="checkbox"><input type="checkbox" name="notch">A Notch (in front)</div>
                <div class="checkbox"><input type="checkbox" name="speaker">A Loud Speaker</div>
                <div class="checkbox"><input type="checkbox" name="stockandroid">Stock Android</div> 
                <div class="checkbox"><input type="checkbox" name="expandablestorage">Expandable Storage (Check this option if SD Card slot is present.)</div>
            </div>
                            
            <button type="submit" class="btn btn-block" style="font-size: 16px; font-family: monospace">
                Submit Review</button>
            </form>
    
        </div>
        </div>
        
        <div class="col-md-2"></div>
        
    </body>
    
</html>

