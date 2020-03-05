<?php
include("dbcon1.php");
session_start();

if(isset($_SESSION['sid']))
{
    $id = $_SESSION['sid'];
    $query = "update record set status = 0 where id = '$id'";
    mysqli_query($con,$query);
    session_destroy();
    header("location:login.php");

}
else{
    
    header("location:login.php");
}
?>