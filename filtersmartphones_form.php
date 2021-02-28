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
        
            <form action="smartphonesforme.php" 
                  style="background-color: lightyellow; border: solid blue 5px;
                  padding-left: 50px; padding-right: 50px" method='POST'>
                <center>
                    <h2 style="font-family: serif">Let us know your requirements:</h2>
                </center>
            
            <div class="form-group">
                <label style="font-size: 20px; font-family: sans-serif; margin-right: 40px">
                    Your Operating System preference:</label>
                <div class="checkbox"><input type="checkbox" name="android">Android</div>
                <div class="checkbox"><input type="checkbox" name="ios">IOS</div>
            </div>
            
            <div class="form-group">
                <label style="font-size: 20px; font-family: sans-serif; margin-right: 40px">Price Range:</label>
                <div class="checkbox"><input type="checkbox" name="one">Less than 10,000</div>
                <div class="checkbox"><input type="checkbox" name="two">10,000 - 15,000</div>
                <div class="checkbox"><input type="checkbox" name="three">15,000 - 30,000</div>
                <div class="checkbox"><input type="checkbox" name="four">30,000 - 50,000</div>
                <div class="checkbox"><input type="checkbox" name="five">Greater than or equal to 50,000</div>
            </div>
                
            <div class="form-group">
                <label style="font-size: 18px; font-family: sans-serif; margin-right: 40px">
                    Do you record videos in 4K quality?</label>
                <div class="radio"><input type="radio" name="video1">Yes</div>
                <div class="radio"><input type="radio" name="video0">No</div> 
            </div>
                
            <div class="form-group">
                <label style="font-size: 18px; font-family: sans-serif; margin-right: 40px">
                    Do you click pictures in 4K quality?</label>
                <div class="radio"><input type="radio" name="pics1">Yes</div>
                <div class="radio"><input type="radio" name="pics0">No</div> 
            </div>
                
            <div class="form-group">
                <label style="font-size: 18px; font-family: sans-serif; margin-right: 40px">
                    Can you compromise on camera for other important features like battery life & RAM management?</label>
                <div class="radio"><input type="radio" name="cam0">No, I want the best camera.</div>
                <div class="radio"><input type="radio" name="cam1">
                    Yes, I can compromise on camera for other important features.</div>
            </div>
            
            <div class="form-group">
                <label style="font-size: 18px; font-family: sans-serif; margin-right: 40px">
                    Is battery your highest priority?</label>
                <label style="font-size: 18px; font-family: sans-serif; margin-right: 40px">OR </label>
                <label style="font-size: 18px; font-family: sans-serif; margin-right: 40px">
                    Do you use your phone for more than 6 hours in a day? </label>
                <div class="radio"><input type="radio" name="battery1">Yes</div>
                <div class="radio"><input type="radio" name="battery0">No</div>
            </div>
                            
            <div class="form-group">
                <label style="font-size: 18px; font-family: sans-serif; margin-right: 40px">
                    Do you often use your smartphone for gaming?</label>
                <div class="radio"><input type="radio" name="gaming1">Yes</div>
                <div class="radio"><input type="radio" name="gaming0">No</div>
            </div>
                
            <div class="form-group">
                <label style="font-size: 18px; font-family: sans-serif; margin-right: 40px">
                    Do you often use multiple apps simultaneously?</label>
                <div class="radio"><input type="radio" name="ram1">Yes</div>
                <div class="radio"><input type="radio" name="ram0">No</div>
            </div>
                
            <div class="form-group">
                <label style="font-size: 18px; font-family: sans-serif; margin-right: 40px">
                    How much Internal Storage do you need?</label>
                <div class="radio"><input type="radio" name="istorage1">I can manage in less than or equal to 8 GB</div>
                <div class="radio"><input type="radio" name="istorage2">At least 16 GB</div>
                <div class="radio"><input type="radio" name="istorage3">At least 32 GB</div>
                <div class="radio"><input type="radio" name="istorage4">At least 64 GB</div>
                <div class="radio"><input type="radio" name="istorage5">128 GB and above</div> 
            </div>
                            
            <div class="form-group">
                <label style="font-size: 18px; font-family: sans-serif; margin-right: 40px">Must have features:</label>
                <div class="checkbox"><input type="checkbox" name="m_fastcharging">Fast Charging</div>
                <div class="checkbox"><input type="checkbox" name="m_faceunlock">Face Unlock</div>
                <div class="checkbox"><input type="checkbox" name="m_glassback">Glass Back</div>
                <div class="checkbox"><input type="checkbox" name="m_notch">Notch</div>
                <div class="checkbox"><input type="checkbox" name="m_speaker">A Loud Speaker</div>
                <div class="checkbox"><input type="checkbox" name="m_stockandroid">Stock Android</div> 
                <div class="checkbox"><input type="checkbox" name="m_expandablestorage">Expandable Storage</div>
            </div>
                
            <div class="form-group">
                <label style="font-size: 18px; font-family: sans-serif; margin-right: 40px">Must not have features:</label>
                <div class="checkbox"><input type="checkbox" name="mnh_glassback">Glass Back</div>
                <div class="checkbox"><input type="checkbox" name="mnh_notch">Notch</div>                
                <div class="checkbox"><input type="checkbox" name="mnh_stockandroid">Stock Android (I want a custom User Interface)</div>
            </div>
                            
            <button type="submit" class="btn btn-block" style="font-size: 16px; font-family: monospace">
                Submit</button>
            </form>
    
        </div>
        </div>
        
        <div class="col-md-2"></div>
        
    </body>
    
</html>