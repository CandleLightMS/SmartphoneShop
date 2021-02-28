<?php
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];

$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="gHg63FRep4";

// Salt should be same Post Request 

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
  } else {
        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
         }
		 $hash = hash("sha512", $retHashSeq);
  
       if ($hash != $posted_hash) {
	       echo "Invalid Transaction. Please try again";
		   } else {
         echo "<h3>Payment status: ". $status .".</h3>";
         echo "<h4>Your transaction id for this transaction is ".$txnid.". Try making the payment again.</h4>";
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
                margin-left: 5%;
            }
        </style>
   </head>
   
   <body>
       <div class="container-fluid">    
            <div class="row">
                
                <div class="col-md-10"></div>                
                <div class="col-md-2">
                    <form action='loginsession.php'>
                    <div class="btn-group" style="padding-top: 10%">
                        <button type="submit" class="btn btn-primary btn-block" 
                                style="background-color: lightgray; color: black">Back to Home</button>
                    </div>
                </form>
                </div>
                
            </div>
        </div>
   </body>
   
</html>