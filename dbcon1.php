<?php
$usn = "root";
$pass = "";
$dbname = "info";
$con = mysqli_connect("localhost",$usn,$pass,$dbname);

if(!$con){
	die ("<h1>Error</h1>".mysqli_error($con));
}


?>