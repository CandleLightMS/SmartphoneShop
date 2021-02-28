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
        
            <form action="saveproduct.php" style="background-color: lightyellow; border: solid black 5px" method='POST'>
            
            <h2>Specifications & Quantity of Product(s)</h2>
            <br>
            
            <div class="form-group">
                <label style="font-size: 20px">Quantity:</label>
                <input type="text" class="form-control" name="qty">
            </div>
    
            <div class="form-group">
                <label style="font-size: 20px">Model:</label>
                <input type="text" class="form-control" name="model">
            </div>
            
            <div class="form-group">
                <label style="font-size: 20px">Brand:</label>
                <select class="form-control" name="brand">                                
                    <option>Google</option>
                    <option>Samsung</option>
                    <option>Apple</option>
                    <option>Vivo</option>
                    <option>Oppo</option>
                    <option>Honor</option>
                    <option>Xiaomi</option>
                    <option>Huawei</option>
                    <option>Other</option>
                </select>
            </div>
            
            <div class="form-group">
                <label style="font-size: 20px">Price:</label>
                <input type="text" class="form-control" name="price">
            </div>
    
            <div class="form-group">
                <label style="font-size: 20px">Box Contents:</label>
                <input type="text" class="form-control" name="box_contents">
            </div>
            
            <div class="form-group">
                <label style="font-size: 20px">Photo:</label>
                <input type="text" class="form-control" name="pic">
            </div>
            
            <div class="form-group">
                <label style="font-size: 20px">Colour:</label>
                <input type="text" class="form-control" name="colour">
            </div>
            
            <div class="form-group">
                <label style="font-size: 20px">Description:</label>
                <input type="text" class="form-control" name="desc">
            </div>
            
            <button type="submit" class="btn btn-group btn-block" style="background-color: lightgray; color: black">Submit</button>
    
        </form>
    
        </div>
        </div>
        
        <div class="col-md-2"></div>
        
    </body>
    
</html>

