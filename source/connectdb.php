<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "db_demo";

$con = mysqli_connect($host, $user, $password, $database);

if (mysqli_connect_errno()){
	echo "connect fail: ".mysqli_connect_errno();exit;
}
?>