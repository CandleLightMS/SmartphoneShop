<?php

include 'config.php';

mysqli_select_db($conn, 'smartphone_shop');

$sql=mysqli_query($conn, "INSERT INTO authorised_sellers (login_id) VALUES ('$_POST[x]')");//

if(!$sql)
{
    echo '<script language="javascript">';
    echo 'alert("The seller could not be approved.")';
    echo '</script>';
}
else 
{
    $sql2=mysqli_query($conn, "DELETE FROM authorisation_requests WHERE login_id = '$_POST[x]'");//

    if(!$sql2)
    {
        echo '<script language="javascript">';
        echo 'alert("Problem in cancelling request.")';
        echo '</script>';
    }
}

header("refresh:0; url=authorisesellers.php");

$conn->close();

?>