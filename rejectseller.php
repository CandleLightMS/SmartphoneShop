<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'config.php';

mysqli_select_db($conn, 'smartphone_shop');

$sql2=mysqli_query($conn, "DELETE FROM authorisation_requests WHERE login_id = '$_POST[y]'");//

if(!$sql2)
{
    echo '<script language="javascript">';
    echo 'alert("Problem in cancelling request.")';
    echo '</script>';
}    

header("refresh:0; url=authorisesellers.php");

$conn->close();

?>