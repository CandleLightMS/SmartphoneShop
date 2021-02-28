<?php

include 'config.php';
mysqli_select_db($conn, 'smartphone_shop');

include 'C:\wamp64\www\PHPMailer.php';
include 'C:\wamp64\www\SMTP.php';
include 'C:\wamp64\www\Exception.php';
include 'C:\wamp64\www\OAuth.php';
include 'C:\wamp64\www\POP3.php';

if(isset($_POST['submitbtn']))
{
    if(!empty($_POST['lid']))
    {
        $flag2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM login WHERE login_id = '$_POST[lid]'"));
        
        if($flag2==0)
        {
            echo '<script language="javascript">
            alert("No such id exists.");
            </script>';
        
            header("refresh: 0; url=forgotpassword.php");
        }
        
        $user_type_query = mysqli_query($conn, "SELECT user_type FROM login WHERE login_id = '$_POST[lid]'");
        
        if(mysqli_num_rows($user_type_query)>0)
        {            
            $login_id = $_POST['lid'];
            
            $user_type_array = mysqli_fetch_row($user_type_query);
            $user_type = $user_type_array[0];
            
            if($user_type[0]=='C')
            {    
                $email_array = mysqli_fetch_row(mysqli_query($conn, "SELECT u_email from customer where login_id= '$login_id'"));
                $email = $email_array[0];
            }
            else if($user_type[0]=='S')
            {    
                $email_array = mysqli_fetch_row(mysqli_query($conn, "SELECT s_email from seller where login_id= '$login_id'"));
                $email = $email_array[0];
            }
            
            $code = rand(100000, 999999);
            
            if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM changepassword_codes WHERE login_id = '$login_id'"))==0)
            {
                mysqli_query($conn, "INSERT INTO changepassword_codes (code, login_id) VALUES ($code, '$login_id')");
            }
            else
            {
                mysqli_query($conn, "UPDATE changepassword_codes SET code = $code WHERE login_id = '$login_id'");
            }
            
            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->IsSMTP();

            $mail->SMTPDebug = 1;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465;
            $mail->IsHTML(true);
            $mail->Username = "msprojects7@gmail.com";
            $mail->Password = "clmsem77";
            $mail->SetFrom("msprojects7@gmail.com");
            $mail->Subject = "Link to Change Password on Smartphone Shop";
            $mail->Body = '<a href = "http://localhost/SmartphoneShop/changepasswordlink.php?'
                    . 'login_id='.$login_id.'&&code='.$code.'">'
                    . 'Click here</a> to change your password.';
            $mail->AddAddress("$email");

            $mail->send();
        }        
    }
    
    if($flag2>0)
    {
        echo '<script language="javascript">
            alert("Go to your email id <'.$email.'> & click on the sent link to set up a new password for your account.");
            </script>';
        
        header("refresh: 0; url=index.php");
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
            <form role="form" method="post" action="index.php">
            <button type="submit" class="btn btn-primary">
            Home</button>
            </form>
        </div>
        </div>        
        
        <div class="col-md-1"></div>
        
        <div class="col-md-4" style="margin-top: 10%; margin-left: 5%; background-color: lightyellow; border: solid 5px lightgray">
            
            <form role="form" method="post" action="">
            
            <h2>Enter your Login Id:</h2>            
                        
            <input type="text" class="form-control" name="lid">            
            
            <br>
            
            <button type="submit" class="btn btn-group" name ="submitbtn" style="border-color: lightgray">Submit</button>
            </form>
            
        </div>
        
    </div>        
    </div>

   </body>
   
</html>