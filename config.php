<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) 
{
    die("Connection failed: " . mysqli_connect_error());
}
/*echo '<script language="javascript">';
echo 'alert("Successfully connected to localhost.")';
echo '</script>';*/